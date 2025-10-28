# ChatGPT para ahorrar tiempo y esfuerzo en la conversión de scripts bash a PowerShell.

# --- 1. Define Paths ---
$ENV_FILE = ".\.env"
$SQL_TEMPLATE = "schema\crear_db_inase_muestras.template.sql"
$SQL_OUTPUT = "schema\crear_db_inase_muestras.sql"

# --- 2. Load Environment Variables (equivalent to 'set -a; source .env; set +a') ---
# This block reads 'export KEY="VALUE"' lines from .env and sets them as PowerShell variables.
Get-Content $ENV_FILE | ForEach-Object {
    # Match 'export KEY=VALUE', capturing KEY and the unquoted VALUE
    if ($_.Trim() -match '^\s*export\s+([A-Z_]+)\s*=\s*("?)(.*?)\2\s*$') {
        Set-Variable -Name $matches[1] -Value $matches[3] -Scope Script
    }
}

# --- 3. Execute Setup ---
Write-Host "Creando Base de Datos '$DB_NAME' y usuario '$DB_USERNAME'..."

# Equivalent to 'envsubst < template.sql > output.sql'
# Replaces placeholders using PowerShell's string expansion and saves the output.
$TemplateContent = Get-Content $SQL_TEMPLATE -Raw
$SubstitutedContent = $ExecutionContext.InvokeCommand.ExpandString($TemplateContent)
$SubstitutedContent | Out-File $SQL_OUTPUT -Encoding UTF8

# Equivalent to 'mysql -u"$USER" -p"$PASS" -h "$HOST" < output.sql'
# Pipes the content of the generated SQL file to the mysql client.
$PasswordArg = "-p$MYSQL_ROOT_PASSWORD"

try {
    Get-Content $SQL_OUTPUT | mysql -u "$MYSQL_ROOT_USERNAME" $PasswordArg -h "$DB_HOST"

    if ($LASTEXITCODE -ne 0) {
        throw "MySQL execution failed with exit code $LASTEXITCODE."
    }
    Write-Host "✅ Base de Datos '$DB_NAME' creada correctamente."
} catch {
    Write-Error "❌ Error durante la ejecución de MySQL: $_"
}
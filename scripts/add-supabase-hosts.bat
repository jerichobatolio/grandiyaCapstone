@echo off
:: Add Supabase direct DB host to Windows hosts file (run as Administrator)
set HOSTS=%SystemRoot%\System32\drivers\etc\hosts
set LINE=2406:da1c:f42:ae13:50db:8048:cff6:6ba2 db.sedxxpoqwceoxvfwihvv.supabase.co

findstr /C:"db.sedxxpoqwceoxvfwihvv.supabase.co" %HOSTS% >nul 2>&1 && (
  echo Entry already exists in hosts.
) || (
  echo # Supabase Grandiya >> %HOSTS%
  echo %LINE% >> %HOSTS%
  echo Done. Added Supabase host to hosts file.
)
pause

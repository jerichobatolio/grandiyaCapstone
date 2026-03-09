@echo off
cd /d "%~dp0"

where git >nul 2>nul || (
  echo Git is not installed. Install from https://git-scm.com/download/win
  echo Then run this file again.
  pause
  exit /b 1
)

if not exist .git (
  git init
  git branch -M main
)

git remote remove origin 2>nul
git remote add origin https://github.com/Mayengskie/capstoneGrandiya.git

git add .
git commit -m "Grandiya Laravel app - initial push" 2>nul || git commit -m "Update Grandiya"
git push -u origin main

echo.
echo Done. Check: https://github.com/Mayengskie/capstoneGrandiya
pause

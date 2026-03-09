# Push Grandiya to https://github.com/Mayengskie/capstoneGrandiya
# Run this AFTER installing Git: https://git-scm.com/download/win

Set-Location $PSScriptRoot

if (-not (Get-Command git -ErrorAction SilentlyContinue)) {
    Write-Host "ERROR: Git is not installed. Install from https://git-scm.com/download/win then run this script again." -ForegroundColor Red
    exit 1
}

if (-not (Test-Path .git)) {
    git init
    git branch -M main
}

git remote remove origin 2>$null
git remote add origin https://github.com/Mayengskie/capstoneGrandiya.git

git add .
git status
Write-Host "`nCommitting and pushing to main..." -ForegroundColor Cyan
git commit -m "Grandiya Laravel app - initial push" 2>$null; if (-not $?) { git commit -m "Update Grandiya" }
git push -u origin main

Write-Host "`nDone. Check: https://github.com/Mayengskie/capstoneGrandiya" -ForegroundColor Green

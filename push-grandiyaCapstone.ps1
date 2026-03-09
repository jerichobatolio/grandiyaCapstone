# Push Grandiya to https://github.com/jerichobatolio/grandiyaCapstone
# Run: .\push-grandiyaCapstone.ps1
# If 403, set token first: $env:GITHUB_TOKEN = "ghp_your_token"; .\push-grandiyaCapstone.ps1

$git = "C:\Program Files\Git\bin\git.exe"
Set-Location $PSScriptRoot

$remote = "https://github.com/jerichobatolio/grandiyaCapstone.git"
if ($env:GITHUB_TOKEN) {
    $url = "https://jerichobatolio:$($env:GITHUB_TOKEN)@github.com/jerichobatolio/grandiyaCapstone.git"
    & $git push $url main 2>&1
} else {
    & $git remote remove origin 2>$null
    & $git remote add origin $remote
    & $git push -u origin main 2>&1
}

if ($LASTEXITCODE -eq 0) { Write-Host "`nDone: https://github.com/jerichobatolio/grandiyaCapstone" -ForegroundColor Green }
else { Write-Host "`nIf 403: Create token at GitHub -> Settings -> Developer settings -> Personal access tokens. Then: `$env:GITHUB_TOKEN = 'ghp_xxx'; .\push-grandiyaCapstone.ps1" -ForegroundColor Yellow }

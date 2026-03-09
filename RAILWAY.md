# Paano i-Deploy ang Grandiya sa Railway (gawing online)

Sundin ang mga hakbang para ilagay ang app sa Railway at maging accessible online. Gumagamit tayo ng **Supabase** bilang database (hindi kailangan ng Railway database).

---

## 1. Ilagay ang code sa GitHub

Kung wala pa ang project sa GitHub:

1. Gumawa ng bagong repository sa [github.com](https://github.com) (hal. `grandiya`).
2. Sa folder ng project (`c:\grandiya`), i-run:

```powershell
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/MO_USERNAME/MO_REPO_NAME.git
git push -u origin main
```

Palitan ang `MO_USERNAME` at `MO_REPO_NAME` ng iyong GitHub username at repo name.

---

## 2. Gumawa ng project sa Railway

1. Pumunta sa **[railway.com](https://railway.com)** at mag-log in (pwedeng gamit GitHub).
2. I-click **“New Project”**.
3. Piliin **“Deploy from GitHub repo”**.
4. Piliin ang repository na **Grandiya** (authorize Railway kung first time).
5. I-click **“Add Variables”** (o **Variables** sa service) bago o pagkatapos ng unang deploy.

---

## 3. I-configure ang Build at Deploy

May **Procfile** at **railway.toml** na sa repo — dapat auto na ang start command (naka-bind sa `PORT` para hindi mag-crash). Kung gusto mo i-override sa dashboard:

1. Puntahan **Settings** ng service.
2. Sa **Build**:
   - **Custom Build Command (optional):**  
     `composer install --no-dev --optimize-autoloader && npm ci && npm run build`
3. Sa **Deploy**:
   - **Custom Start Command (kung nag-crash pa rin):**  
     `sh -c 'php artisan config:cache 2>/dev/null || true; php artisan migrate --force 2>/dev/null || true; php artisan storage:link 2>/dev/null || true; exec php artisan serve --host=0.0.0.0 --port=$PORT'`
4. I-save at **Redeploy**.

---

## 4. Ilagay ang Environment Variables

Sa **Variables** ng service, i-add (Raw Editor o isa-isa):

| Variable | Halaga (palitan kung kailangan) |
|----------|--------------------------------|
| `APP_NAME` | `Grandiya` |
| `APP_ENV` | `production` |
| `APP_KEY` | *(output ng `php artisan key:generate --show` sa PC mo)* |
| `APP_DEBUG` | `false` |
| `APP_URL` | *(ilalagay mamaya – URL na ibibigay ng Railway)* |
| `LOG_CHANNEL` | `stderr` |
| `LOG_STDERR_FORMATTER` | `\Monolog\Formatter\JsonFormatter` |
| `DB_CONNECTION` | `pgsql` |
| `DB_HOST` | `aws-1-ap-southeast-2.pooler.supabase.com` |
| `DB_PORT` | `5432` |
| `DB_DATABASE` | `postgres` |
| `DB_USERNAME` | `postgres.sedxxpoqwceoxvfwihvv` |
| `DB_PASSWORD` | *(Supabase database password mo)* |
| `SESSION_DRIVER` | `database` |
| `CACHE_STORE` | `database` |
| `QUEUE_CONNECTION` | `database` |

**Paano kunin ang APP_KEY (sa PC mo):**

```powershell
cd c:\grandiya
php artisan key:generate --show
```

Kopyahin ang value at ilagay sa variable na `APP_KEY` sa Railway.

---

## 5. I-generate ang public URL (domain)

1. Sa service, pumunta sa **Settings** → **Networking** (o **Generate Domain**).
2. I-click **“Generate Domain”**.
3. Makukuha mo ang URL (hal. `https://grandiya-production-xxxx.up.railway.app`).
4. Balik sa **Variables**, i-add o i-edit:
   - `APP_URL` = `https://MO_DOMAIN.up.railway.app` (exact URL na binigay ng Railway, walang trailing slash).
5. I-**Redeploy** para ma-pick up ang bagong `APP_URL`.

---

## 6. I-deploy / I-redeploy

- Kung first time: pagkatapos mag-add ng variables, mag-deploy na nang automatic o i-click **Deploy**.
- Pag nagbago ka ng variables (lalo na `APP_URL`): i-click **Redeploy** sa latest deployment.

Pag tapos, buksan ang **APP_URL** sa browser — dapat nandoon na ang Grandiya.

---

## Maikling checklist

- [ ] Code naka-push sa GitHub
- [ ] Railway project, deploy from GitHub repo
- [ ] Custom Build: `composer install --no-dev --optimize-autoloader && npm ci && npm run build`
- [ ] Pre-Deploy: migrate + config:cache + storage:link (o `railway/init-app.sh`)
- [ ] Variables naka-set (APP_KEY, APP_URL, DB_* Supabase, LOG_CHANNEL=stderr)
- [ ] Generate Domain na-set, APP_URL na-update, Redeploy

---

## Bakit mabilis mag-crash (CRASHED)

1. **Walang naka-listen sa PORT** — Dapat ang app ay `php artisan serve --host=0.0.0.0 --port=$PORT`. May **Procfile** at **railway.toml** na sa repo para dito. Kung nag-crash pa rin, i-set sa **Settings → Deploy → Custom Start Command** ang command sa section 3 above.
2. **Kulang o maling env vars** — Kung walang `APP_KEY` o mali ang `DB_*` (Supabase), Laravel ay mag-fail sa boot at mag-exit → crash. Tignan **Variables** at siguraduhing naka-set lahat (lalo na `APP_KEY`, `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`).
3. **Tignan ang Logs** — Sa Railway, **Deployments** → i-click ang deployment → **View Logs**. Doon makikita ang PHP error (e.g. "No application encryption key", "could not find driver", "Connection refused").

## Kung may error

- **500 / white screen:** Tignan **Logs** sa Railway. Siguraduhing tama ang `APP_KEY` at lahat ng `DB_*` (Supabase).
- **CSS/JS walang load:** Tignan na na-run ang `npm run build` at tama ang `APP_URL` (https, walang trailing slash).
- **Images/profile photos 404:** Dapat na-run ang `php artisan storage:link` (kasama sa start command). Kung naka-upload na sa Supabase/Storage ang files, baka kailangan ng separate storage config (e.g. S3) para sa production uploads.

Kung gusto mo, next step ay pwedeng i-set up ang **custom domain** (sariling domain) sa Railway pag handa ka na.

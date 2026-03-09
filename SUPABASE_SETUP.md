# Paano Gamitin ang Supabase sa Grandiya

## Bakit hindi gumagana ngayon

1. **Direct connection** (`db.xxx.supabase.co`) – Hindi na-re-resolve ng DNS ng PC/network mo, o naka-IPv6 lang ang Supabase at walang IPv6 ang network mo.
2. **Pooler** – Nakakonekta na sa pooler, pero "Tenant or user not found". Kailangan ang **eksaktong** connection details mula sa Supabase Dashboard.

## Gawin mo (para gumana ang Supabase)

### 1. Kunin ang tamang connection details sa Supabase

1. Buksan ang **Supabase Dashboard** → project **Grandiya**.
2. I-click ang **Connect** (sa taas, malapit sa project name).
3. Piliin **Session mode** (o **Transaction mode** kung para sa serverless).
4. Sa **Connection string**, i-click **"URI"** o **"View parameters"**.
5. Kopyahin:
   - **Host** (hal. `aws-0-ap-southeast-1.pooler.supabase.com` o iba)
   - **Port** (5432 o 6543)
   - **User** (hal. `postgres.XXXXXXXX` – may project ref)
   - **Database**: karaniwang `postgres`
   - **Password**: yung sa Database password

### 2. I-update ang `.env`

Buksan ang `c:\grandiya\.env` at palitan ang DB lines ng nakopya mo:

```env
DB_CONNECTION=pgsql
DB_HOST=<Host mula sa Supabase>
DB_PORT=<Port mula sa Supabase>
DB_USERNAME=<User mula sa Supabase>
DB_DATABASE=postgres
DB_PASSWORD="<database password>"
```

### 3. Clear config at subok

```powershell
cd c:\grandiya
php artisan config:clear
php artisan migrate --force
```

### 4. (Opsyonal) Kung gusto mong i-try ang direct connection

Kung may **IPv6** na ang network mo, o gusto mong i-try ang direct hostname:

1. I-run **as Administrator** ang: `scripts\add-supabase-hosts.bat`
2. I-set sa `.env` ang direct host, hal.  
   `DB_HOST=db.sedxxpoqwceoxvfwihvv.supabase.co`  
   at `DB_USERNAME=postgres` (walang `.xxx`).
3. Subukan ulit: `php artisan db:show`

---

**Para gumana muna ang app:** Kung hindi mo pa naaayos ang Supabase, naka-set ang `.env` sa **MySQL** (127.0.0.1). Siguraduhing naka-run ang MySQL sa XAMPP at may database na `grandiya`, tapos `php artisan migrate`.

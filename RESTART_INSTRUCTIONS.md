# How to Fix the Upload Error

The GD extension has been enabled in `php.ini`, but Apache needs to be restarted to load it.

## Steps to Fix:

### 1. Open XAMPP Control Panel
   - Look for XAMPP icon in your system tray or start menu
   - Open "XAMPP Control Panel"

### 2. Restart Apache
   - Click the **"Stop"** button next to Apache
   - Wait a few seconds
   - Click the **"Start"** button next to Apache

### 3. Verify the Fix
   - Go to: http://localhost:8000/user/profile
   - Try uploading a photo again
   - It should work now! ✅

## Alternative: If using `php artisan serve`

If you're using `php artisan serve` instead of Apache:

1. Stop the server (press Ctrl+C in the terminal)
2. Start it again:
   ```bash
   php artisan serve
   ```

## What We Fixed:
- ✅ Enabled GD extension in php.ini
- ✅ Created storage directories
- ✅ Configured Intervention Image
- ✅ Cleared all caches

Now you just need to restart Apache to load the GD extension!


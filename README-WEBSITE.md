# Yvonne Hangara - Personal Website

A complete, production-ready single-page website for Yvonne "Yvy" Hangara, Christian educator, author, and musician.

## Features

- Single-page responsive design
- Bio/About section as the landing page
- Music & Ministry highlights
- Books section featuring "The State of Today's Church" (currently writing)
- Interactive image gallery with lightbox
- Functional contact form with PHP backend
- Mobile-friendly navigation
- Smooth scrolling and elegant animations

## Installation Instructions

### For Shared Hosting (cPanel, etc.)

1. **Update Email Address**
   - Open `index.php`
   - On line 18, change `your-email@example.com` to your actual email address:
   ```php
   $to = "your-actual-email@example.com";
   ```

2. **Upload to Server**
   - Upload `index.php` to your hosting public directory (usually `public_html` or `www`)
   - Ensure PHP is enabled on your server (most shared hosting has this by default)

3. **Test the Website**
   - Visit your domain in a web browser
   - Test all sections: navigation, gallery lightbox, contact form
   - Send a test message through the contact form

### Technical Requirements

- PHP 5.4 or higher (most servers have PHP 7+ by default)
- Mail function enabled (standard on shared hosting)
- No database required
- No special server configuration needed

## File Structure

The entire website is contained in a single file:
- `index.php` - Complete website with HTML, CSS, JavaScript, and PHP

## Customization

### Adding Your Own Images

**Profile/Bio Image:**
Currently, the bio section displays text only. To add a profile image:
1. Upload your image to the server
2. Uncomment the bio-image div in the HTML
3. Update the image src to point to your image

**Book Cover:**
Replace the placeholder book image URL on line 644 with your actual book cover image.

**Gallery Images:**
Replace the Pexels stock photo URLs (lines 651-668) with your own ministry photos:
```html
<div class="gallery-item" data-image="path/to/your-image.jpg">
    <img src="path/to/your-image.jpg" alt="Your Description">
</div>
```

### Updating Content

All content is directly in the HTML. Simply search for the section you want to modify:
- Bio content: Search for "Yvonne 'Yvy' Hangara is a believer"
- Ministry highlights: Search for "ministry-highlights"
- Book content: Search for "Dear Reader"

### Color Scheme

The website uses a professional blue color scheme defined in CSS variables (lines 78-87):
- Primary: `#2c5f7d` (Deep blue)
- Secondary: `#4a7c9e` (Medium blue)
- Accent: `#d4a574` (Gold)

To change colors, update these CSS variables in the `:root` section.

### Social Media Links

Update the social media links in the footer (lines 676-679):
```html
<a href="https://facebook.com/yourpage">Facebook</a>
```

## Support

For technical issues or questions about deployment, ensure:
1. PHP is enabled on your server
2. The mail() function is working (test with a simple script)
3. File permissions are correctly set (usually 644 for PHP files)

## License

This website is created for Yvonne Hangara's personal and ministry use.

# Mount IDA Redesign Animation prototype

### Installing

1. Clone repo
2. `npm install`

If `/src/scss/bourbon` or `/src/scss/neat` are missing
3. (If Bourbon is not installed on system) `gem install bourbon`
4. (If Neat is not installed on your system) `gem install neat`
5. `cd /src/scss`
6. `bourbon install` and `neat install`

### Dev

All dev work is in the `src` folder. For production, the site will serve up files from `dist`.
Run `gulp` and the `dist` folder will be created and filled with minified css and js, and compressed images.
Edit `functions.php` and set `$cp_base ` to `dist` to start serving up the compressed, minified files in `/dist`

### Templates

__NB__: References to `/src` can be replaced with `/dist` (see _Dev_ above).

Template files are in `/src`, individual pages are in `/src/pages`

WordPress template files are still in `/` as usual, but refer to the `partials` and `pages` directories in `/src`. The template files in `/` use a variable called `$pagename` to determine which files to load. `$pagename` determines:
  - Template: `src/pages/$pagename.php`
  - JS: `src/js/pages/$pagename.js` (you can have encapsulated, page-specific js)
  - SCSS: `src/scss/pages/$pagename.js` (these are all put together in one file, but you can separate out directives in various sass files. If you add a new one, remember to update `src/scss/main.scss`)

Use the `assemble_template` function (defined in `functions.php`) to quickly assemble a quick page (with head, nav, body, and footer).
You can skip the `assemble_template` function and include files on your own. Just take note how the function is using the `$cp_base ` and `$pagename` variables

### Testing Deploy tools

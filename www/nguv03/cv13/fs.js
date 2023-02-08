var fs = require('fs');

fs.readdirSync('./htaccess1').forEach((item) => {
    if (!fs.lstatSync('./htaccess1/' + item).isDirectory()) {
        return fs.writeFileSync('./htaccess1/' + item, '// ./htaccess1/' + item);
    }
    fs.readdirSync('./htaccess1/' + item).forEach((subItem) => {
        fs.writeFileSync('./htaccess1/' + item + '/' + subItem, '// ./htaccess1/' + item + '/' + subItem);
    });
});
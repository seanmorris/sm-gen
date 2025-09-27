// static/example.js - sample custom script
document.addEventListener('DOMContentLoaded', function() {
    console.log('Example.js loaded');
    document.querySelectorAll('a').forEach(function(el) {
        el.addEventListener('click', function() {
            console.log('Link clicked:', el.href);
        });
    });
});
const themes = ['default', 'cosmic', 'techno'];
let currentTheme = 2;

document.addEventListener('DOMContentLoaded', () => {
	const de = document.documentElement;

	document.addEventListener('keyup', event => {
		console.log(event.code);
		if(event.code === 'KeyQ')
		{
			event.preventDefault();
			currentTheme++;

			if(currentTheme >= themes.length)
			{
				currentTheme = 0;
			}

			de.classList.forEach(cssClass => {
				if(cssClass.match(/^theme-/))
				{
					de.classList.remove(cssClass);
				}
			})

			de.classList.add(`theme-${themes[currentTheme]}`);

			console.log(`theme-${themes[currentTheme]}`);

			console.log(currentTheme);
		}
	});
});

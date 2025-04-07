const root = document.documentElement;
function changeTheme() {
	console.log("loaded");

	if (localStorage.getItem('colors') == null) {
		console.log("cancelled");
		return

	}
	let colorFromStorage = JSON.parse(localStorage.getItem('colors'))
	//console.log("Storage colors",colorFromStorage);

	Object.entries(colorFromStorage).forEach((key) => {
		//console.log(key[1].color);
		let color = key[1].color
		let property = key[1].location
		//root.style.setProperty();

		//console.log(color,property,"Iteration ");

		root.style.setProperty(`--${property}`, `${color}`);
	})

	// Get the root element	
	// Update CSS variables


}

document.addEventListener("DOMContentLoaded", function () {
	console.log("DOM fully loaded and parsed!");
	changeTheme()
	// Your function here
});
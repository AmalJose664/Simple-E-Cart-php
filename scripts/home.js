const cartNum = document.querySelector('.trolley span')
//console.log(cartNum.innerHTML);

if(cartNum.innerHTML==""){
	cartNum.remove()
}
function cart(e,id){
	
	if(cartNum.innerHTML>=10){
		alert("Maximum cart reached")
		e.preventDefault();
	}
	elementId = document.getElementById(id);
	//console.log(elementId,id);
	
	//console.log(elementId.innerHTML);
	if (elementId.innerHTML ==="Not Available"){
		//console.log(elementId.innerHTML);
		e.preventDefault();
		alert("Requested product was not in 'Stock'.Please order something else");
		
		
	}
	

}

const paramss = new URLSearchParams(window.location.search)
//console.log(paramss);
const availability= paramss.get('Availability');
//console.log(availability);

if(availability==0){
	alert("Requested product was not in 'Stock'.Please order something else");
}


function formcheck_fecha(el){
	if (!el.value.test(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/)) {
		el.errors.push("El formato de fecha debe ser dd/mm/aaaa"); 
		return false;
	} else {
		return true;
	}
}

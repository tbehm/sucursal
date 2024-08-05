	console.log("hola");
	const bg_color = document.getElementById('bg_color');
	bg_color.addEventListener('input',function(){
		document.documentElement.style.cssText = `--bg-color:${bg_color.value}`;
	})
	const header = document.getElementById('header_col');
	header.addEventListener('input',function(){
		document.documentElement.style.cssText = `--header-color:${header.value}`;
	})
	const th_color = document.getElementById('th_color');
	th_color.addEventListener('input',function(){
		document.documentElement.style.cssText = `--table-th-color:${th_color.value}`;
	})
	const font_color = document.getElementById('font_color');
	font_color.addEventListener('input',function(){
		document.documentElement.style.cssText = `--header-font-color:${font_color.value}`;
	})
	const btn_color = document.getElementById('btn_color');
	btn_color.addEventListener('input',function(){
		document.documentElement.style.cssText = `--button-color:${btn_color.value}`;
	})
	const aside_color = document.getElementById('aside_color');
	aside_color.addEventListener('input',function(){
		document.documentElement.style.cssText = `--aside-color:${aside_color.value}`;
	})
	const aside_btn_color = document.getElementById('aside_btn_color');
	aside_btn_color.addEventListener('input',function(){
		document.documentElement.style.cssText = `--aside-btn-color:${aside_btn_color.value}`;
	})
	
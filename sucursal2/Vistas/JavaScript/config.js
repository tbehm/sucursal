const file=document.getElementById('foto')
const img=document.getElementById('img')
const defaultFile=img.src

file.addEventListener('change',e=>{
	if (e.target.files[0]) {//SI selecciona una imagen la muestre
		const reader = new FileReader()
		reader.onload = function (e) {
			img.src=e.target.result;	
		}
		reader.readAsDataURL(e.target.files[0])
	}//SI selecciona una imagen la muestre
	else{//SI no selecciona una imagen la muestre la actual
		img=src=defaultFile
	}//SI no selecciona una imagen la muestre la actual
});
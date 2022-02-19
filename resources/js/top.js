var url = location.href ;
let basic_list = document.getElementById('store_introduction');

if (basic_list != null) {
	let sentence = basic_list.textContent;
	let modStr = '';
	if(sentence.length > 20){
	  modStr = sentence.substr(0, 20) + '...'
	}
	basic_list.textContent = modStr;
}


export const out_console = function(error, name) {
	console.error('ERROR!! occurred in Backend. ('+name+')', error);
	//catch the error, check it has a response object with lodash 
	if(_.has(error, 'response')) {
		console.error("status : " + error.response.status);  
		console.error("data : " + JSON.stringify(error.response.data));
	} else {
		console.error("Most likely a server timeout or an internet connection error");
		console.error("error response property is undefined");
	}
}
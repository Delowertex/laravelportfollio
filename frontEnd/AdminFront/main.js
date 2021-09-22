function getTodos(){
	console.log('Get Reguest');
}
function addTodos(){
	console.log('post Reguest');
}
function updateTodos(){
	console.log('put/patch Reguest');
}
function removeTodos(){
	console.log('delete Reguest');
}
function getData(){
	//console.log('Semoltanious Reguest');
}
function customHeader(){
	//console.log('Custom Header');
}

function transformResponse(){
	//console.log('TRansform Request');
}

function errorHandeling(){
	//console.log('Error Handeling');
}

function cancelToken(){
	//console.log('Cencel Token');
}

function showOutput(res){
	document.getElementById('res').innerHTML = '<div class="card card-body mb-4">
		<h5>Status: ${res.status}</h5>
	</div>';
}
	// <div class="card mt-3">
	// 	<div class="card-header">
	// 		Header
	// 	</div>
	// 	<div class="card-body">
	// 		<<pre>${JSON.stringify(res.headres, null, 2)}</pre>
	// 	</div>
	// </div>
		
		// <div class="card mt-3">
		// 	<div class="card-header">
		// 		Data
		// 	</div>
		// 	<div class="card-body">
		// 		<<pre>${JSON.stringify(res.data, null, 2)}</pre>
		// 	</div>
		// </div>
		// <div class="card mt-3">
		// 	<div class="card-header">
		// 		Config
		// 	</div>
		// 	<div class="card-body">
		// 		<<pre>${JSON.stringify(res.config, null, 2)}</pre>
		// 	</div>
		// </div>';


document.getElementById('get').addEventListener('click', getTodos);
document.getElementById('post').addEventListener('click', addTodos);
document.getElementById('update').addEventListener('click', updateTodos);
document.getElementById('delete').addEventListener('click', removeTodos); 
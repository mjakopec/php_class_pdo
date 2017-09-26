$( document ).ready(function() {
    console.log( "ready!" );
	initial_start();

$( "#button-form-1" ).click(function() {//Create
 var form = $('form.form-1').serializeArray();
 form.push({name:'action',value:this.value});
 form.push({name:'target',value:this.name});
  $.ajax({
  method: "POST",
  url: "data_manipulation.php?action="+this.value,
  data: form
 })
  .done(function( msg ) {
	location.reload();
  });
});

$(document).on("click", "a[name^='get-']", function(event) { //Read<->Get item
    $.getJSON({
  	url: "data_manipulation.php?action=Get&id="+this.name
    })
   .done(function( msg ) {
  	var InputItem = $( ".form-control" );
  	var how_many=(InputItem.index());
  	for (i=0; i<=how_many; i++)
  	{
  		$("#control"+i).val(msg[i]);
  	}
    });
    });
  
$( "#button-form-2" ).click(function() {//Update
 var form = $('form.form-1').serializeArray();
 form.push({name:'action',value:this.value});
 form.push({name:'target',value:this.name});
  $.ajax({
  method: "POST",
  url: "data_manipulation.php?action="+this.value,
  data: form
  })
  .done(function( msg ) {
	location.reload();
  });
});
	
$(document).on("click", "a[name^='delete-']", function(event) { //Delete
    $.ajax({
  	method: "POST",
  	url: "data_manipulation.php?action=Delete&id="+this.name
    })
   .done(function( msg ) {
    location.reload();
    });
});
	
function initial_start(){//Read get all items 
  $.ajax({
  method: "POST",
  url: "data_manipulation.php?action=Read&target=user"
  })
  .done(function(data){
  	$("#holder").html(data);
  });
  }
});
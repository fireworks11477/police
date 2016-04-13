<select id="AB" onchange="ABC(this.value)">
<option value="a">123</option>
<option value="b">456</option>
</select>

<script type="text/javascript">
function ABC(abc){
	
	alert(abc);
}
</script>

<script>
/*
$('#qww select').live('change',function(){
	var id = $(this).attr('value');	
	var now = $(this).attr('id').substr(5);
	
	$.ajax({
	   type:"GET",
	   url:'__ROOT__/index.php/Admin/Common/category_id/id/'+id,
	   dataType:'json',
	   success:function(json){
	   //alert(json);return false;
	   if(json == ''){return false;}
	   var next = Number(now)+1;
	   var temp = next;
	   while($('#jibie'+temp).length != 0){
			$('#jibie'+temp).remove();
			temp++;
	   }
			 var qwerty = '';
			 qwerty +='<select name="category_id" id="jibie'+next+'">';
				for(var i = 0;i<json.length;i++){
					qwerty +='<option value="'+json[i].id+'">'+json[i].name+'</option>';
				}
			 qwerty +='</select>';
			$('#qww').append(qwerty);
			
	   }
	});
	return false;
});
*/
</script>

<script>
/*
$('#a33').live('change',function(){
	var url = $(this).attr('value');
	var abc = $('#content').attr('abc');
	$.ajax({
		type:"GET",
		url:url,
		dataType:'json',
		beforeSend: function() {
            $("#loading").html('<section class="mod model-1"><div class="spinner"></div></section>');
        },
		success:function(json){
			var content = '';
			for(var i = 0;i<json.result.length;i++){
			   content +='<tr>';
			   content +='<td>'+json.result[i].id+'</td>';
			   content +='<td>'+json.result[i].name+'</td>';
			   content +='<td>'+json.result[i].email+'</td>';
			   if(json.result[i].updated_at === null){
					content +='<td>该用户从未登录</td>';
			   }else{
				   content +='<td>'+json.result[i].updated_at+'</td>';
			   }
			   content +='<td>';
			   content +='<a href="/Admin/update/'+json.result[i].id+'" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a>'; 
			   content +='<a href="/Admin/update/'+json.result[i].id+abc+'" title="删除"><span class="glyphicon glyphicon-remove" ></span></a> ';
			   content +='</td>';
			   content +='</tr>';
		 	}
			$("#loading").html('');
			$('#qwe').attr('paga',1);
			$('#content').html(content);
			$('#zxc').html(json.page);
		}
	})
	return false;
})
*/
</script>
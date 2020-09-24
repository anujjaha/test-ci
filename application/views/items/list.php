<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}

	td {
		border: 1px solid black;
		padding: 5px;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Item List</h1>

	<div id="body">
		<table style="border: 2px solid black;">
			<tr >
				<td>Sr</td>
				<td>Title</td>
				<td>Price</td>
				<td>Description</td>
				<td>Action</td>
			</tr>

			<?php
				if(isset($items) && is_array($items) && count($items))
				{
					$sr = 1;
					foreach($items as $item)
					{
				?>
						<tr id="recordId-<?=$item['id'];?>">
							<td><?= $sr;?></td>
							<td><?= $item['title'];?></td>
							<td><?= $item['price_with_tax'];?></td>
							<td><?= $item['description'];?></td>
							<td>
								<a href="http://localhost/ci/items/edit/<?= $item['id'];?>">
									Edit
								</a>
								&nbsp; &nbsp; || &nbsp; &nbsp; 
								<a href="javascript:void(0);" class="delete-item" data-id="<?= $item['id'];?>">
									Delete
								</a>
							</td>
						</tr>
				<?php
					$sr++;
					}
				}
			?>
		</table>
	</div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function()
{
	jQuery('.delete-item').on('click', function(e) {
		deleteItem(e.target);
	})
});

/**
 * Delete Item
 * 
 * @param Element HTML
 */
function deleteItem(element)
{
	var itemId = jQuery(element).attr('data-id'),
		status = confirm("Are you sure, you want to delete record?");

	if(!status) {
		return;
	}

	jQuery.ajax(
	{
		url:  "<?= base_url();?>items/delete",
		type: "POST",
		dataType: "JSON",
		data: {
			itemId: itemId
		},
		success: function(data) {
			if(data.status == true)
			{
				jQuery("#recordId-"+itemId).hide();
				alert(data.message);
				return;
			}

			alert(data.message);
			return;
		},	
		error: function(data) {
			console.log("error", data);
		},
		complete: function() {
			console.log("completed");
		}
	});
}
</script>
</html>
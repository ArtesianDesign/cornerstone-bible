<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$ih = Loader::helper('concrete/interface');
$valt = Loader::helper('validation/token');
$form = Loader::helper('form');
Loader::model('resource_library', 'resource_library');
?>

<style type="text/css">
.ccm-dashboard-inner form label { display:inline-block; width:120px; margin-right:5px; text-align:right; }
.ccm-dashboard-inner form td { padding:4px 0; }

.ccm-dashboard-inner table.resources_list { border:1px solid #ccc; border-left:0; border-top:0; }
.ccm-dashboard-inner table.resources_list th { padding:1px 4px; border-left:1px solid #ccc; border-top:1px solid #ccc; border-bottom:1px solid #ccc; }
.ccm-dashboard-inner table.resources_list td { padding:1px 4px; border-left:1px solid #ccc; border-top:1px dotted #ddd; }
.ccm-dashboard-inner table.resources_list tr.even { background:#eee; }
table#resource-library-list .button-cell {
	max-width: 34px;
}
</style>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Resource Library'), t('Manage a library of audio, visual and document resources. Great for lectures or sermons and their corresponding documents.'), 'span12', true); ?>
	<table id="resource-library-list" class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>Date</th>
				<th>Title</th>
				<th>Author</th>
				<th>Reference</th>
				<th>Series</th>
				<th>Audio File</th>
				<th class="button-cell">&nbsp;</th>
				<th class="button-cell">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$rowNum = 1;
		
		//List generate row for each resource item:
		foreach ($resources as $resource) {
			if ($rowNum&1) { $rowClass = 'odd'; } else { $rowClass = 'even'; }
			$deleteLink = '<a class="btn deleteBtn" title="Delete" href="' . $this->url('/dashboard/resource_library/manage/list', 'request_delete', $resource['sermon_id']) . '"><i class="icon-remove"</i></a>';
			$editLink = '<a class="btn" title="Edit" href="' . $this->url('/dashboard/resource_library/manage/edit', 'edit_item' , $resource['sermon_id']) . '"><i class="icon-pencil"></i></a>';
			$html = '<tr class="' . $rowClass . '" id="resource' . $rowNum . '">';
			$html .= '<td>' . date('F j, Y', strtotime($resource['date'])) . '</td>';
			$html .= '<td>' . $resource['title'] . '</td>';
			$html .= '<td>' . $resource['speaker_name'] . '</td>';
			$html .= '<td>' . $resource['reference'] . '</td>';
			$html .= '<td>' . $resource['series_name'] . '</td>';
			$html .= '<td>' . $resource['mp3file'] . '</td>';
			$html .= '<td class="button-cell">' . $editLink . '</td>';
			$html .= '<td class="button-cell">' . $deleteLink . '</td>';
			$html .= '</tr>';
			echo $html;
			$rowNum++;
		} ?>
		</tbody>
	</table>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>
<script type="text/javascript">
$(function(){
	$('#resource-library-list a.deleteBtn').click(function(e){
		var answer = confirm("Are you sure you want to delete this resource item?");
		if (!answer) {
			e.preventDefault();
		}
	});
});
</script>
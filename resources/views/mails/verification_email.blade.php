Hello <i>{{ $demo->receiver }}</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>
 
<p><u>Demo object values:</u></p>
 
<div>
<p><b>Name : </b>&nbsp;{{ $demo->name }}</p>
<?php if(isset($demo->activation_code) && $demo->activation_code){ ?>
	<p><b>Activation Code :</b>&nbsp;{{ url('/auth/verification?code=' . $demo->activation_code) }}</p>
<?php } ?>
<?php if(isset($demo->study_class_details) && $demo->study_class_details){ ?>
	<p><b>Detail Class :</b></p>
	<table>
		<thead>
			<th>No</th>
			<th>Nama Guru</th>
			<th>Pelajaran</th>
			<th>Jadwal</th>
			<th>Kode Unik</th>
		</thead>
		<tbody>
		<?php 
			$study_class_details = $demo->study_class_details;
			$i = 1;
			foreach ($study_class_details as $study_class_detail) { ?>
			<td><?php echo $i ?></td>
			<td><?php echo $study_class_detail->teacher_name ?></td>
			<td><?php echo $study_class_detail->subject_name ?></td>
			<td><?php echo $study_class_detail->study_start_at ?></td>
			<td><?php echo $study_class_detail->unique_code ?></td>
		<?php $i++;	}
		?>
		</tbody>
	</table>
<?php } ?>
</div>
 
Thank You,
<br/>
<i>{{ $demo->sender }}</i>
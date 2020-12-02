<h2>documents</h2>
	<div class='form-group'>
		<?php if ($_SESSION["profil"] == 1) { ?>
			<div class='form-group'>
				<label for='lstusers'>Filter by users</label>
				<select class='form-control' id='lstusers' name='lstusers'>
					<?= Entity::HTMLselect("select * from user", "use_username", "use_username", $use_username) ?>
				</select>
			</div>
		<?php } ?>

		<div class='form-group'>
			<label for='lstkeywords'>Filter by keywords</label>
			<select class='form-control lstkeywords' id='lstkeywords' name='lstkeywords' multiple>
				<?= Entity::HTMLselect("select * from keywords", "key_label", "key_label", $key_label) ?>
			</select>
		</div>

		<form>
			<label>Search (coming soon)</label>
			<input type="text" id="search" size="30" disabled='disabled'>
			<div id="search"></div>
		</form>
	</div>
	<div id="resultat"></div>



	<table class="table table-striped table-bordered table-hover" id="lstdocuments">
		<thead>
			<tr>

				<th>Id</th>
				<th>Label</th>
				<th>Note</th>
				<th>Audio memo</th>
				<th>Date</th>
				<th>Private</th>
				<th>Validation</th>
				<?php if ($_SESSION['profil'] == 1) { ?>
					<th>User</th>
				<?php } ?>
				<th>Keywords</th>
				<th>Add keyword</th>
				<th>Files</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($result as $row) {
				extract($row); ?>
				<tr class='<?= mhe($row['use_username']) . " " . Documents::kwSearch($doc_id) ?>'>

					<td><?= mhe($row['doc_id']) ?></td>
					<td><?= mhe($row['doc_label']) ?></td>
					<td><?= mhe($row['doc_note']) ?></td>
					<td><?= mhe($row['doc_audio_src']) ?></td>
					<td><?= mhe($row['doc_date']) ?></td>
					<?php if ($row['doc_private'] == 'On') { ?>
						<td><?= mhe($row['doc_private']) ?></td>
					<?php } else { ?>
						<td>Off</td>
					<?php } ?>
					<td><?= mhe($row['doc_validation']) ?></td>
					<?php if ($_SESSION['profil'] == 1) { ?>
						<td><?= mhe($row['use_username']) ?></td>
					<?php } ?>
					<td><?= Documents::kwSearch($doc_id) ?> </td>
					<td><a class="btn btn-secondary" href="<?= hlien("search", "edit", "id", $row["doc_id"]) ?>"><?= Documents::keyCounter($row["doc_id"])['nb'] ?></a></td>
					<!--<td><a class="btn btn-secondary" href="<?= hlien("search", "edit", "id", $row["doc_id"]) ?>"><?= Documents::kwSearch($doc_id) ?></a></td>-->
					<td><a class="btn btn-primary" href="<?= hlien("files", "index", "id", $row["doc_id"]) ?>"><?= Documents::fileCounter($row["doc_id"])['nb'] ?></a></td>
					<td><a class="btn btn-primary" href="<?= hlien("documents", "edit", "id", $row["doc_id"]) ?>">Edit</a></td>
					<td><a class="btn btn-danger" href="<?= hlien("documents", "del", "id", $row["doc_id"]) ?>">Delete</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<p><a class="btn btn-primary" href="<?= hlien("documents", "edit", "id", 0) ?>">New document</a></p>


	<script>
		let myTable = document.getElementById("lstdocuments");
		let listtr = myTable.querySelectorAll("tbody>tr");

		//order
		/************/
		//https://www.pierre-giraud.com/trier-tableau-javascript/

		const tbody = document.querySelector('tbody');
		const thx = document.querySelectorAll('th');
		const trxb = tbody.querySelectorAll('tr');
		const compare = function(ids, asc) {
			return function(row1, row2) {
				const tdValue = function(row, ids) {
					return row.children[ids].textContent;
				}
				const tri = function(v1, v2) {
					if (v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2)) {
						return v1 - v2;
					} else {
						return v1.toString().localeCompare(v2);
					}
					return v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
				};
				return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
			}
		}


		thx.forEach(function(th) {
			th.addEventListener('click', function() {
				let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
				classe.forEach(function(tr) {
					tbody.appendChild(tr)
				});
			})
		});

		

		/*VERSION FACTORISEE*/
		/*
		const compare = (ids, asc) => (row1, row2) => {
			const tdValue = (row, ids) => row.children[ids].textContent;
			const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
			return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
		};

		const tbody = document.querySelector('tbody');
		const thx = document.querySelectorAll('th');
		const trxb = tbody.querySelectorAll('tr');
		thx.forEach(th => th.addEventListener('click', () => {
			let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
			classe.forEach(tr => tbody.appendChild(tr));
		}));

*/
		
//filters
		//1. filter: user 
		let selectUser = document.getElementById("lstusers");
		selectUser.addEventListener("change", function() {
			listtr.forEach(tr => {
				tr.style.display = "none";
				if (tr.className.includes(selectUser.value))
					tr.style.display = "table-row";
			});
		});

		//2. filter : key 
		//v0
		let listInput = document.getElementById('lstkeywords');
		let listOption = listInput.querySelectorAll('option');
		listInput.addEventListener("change", filterByKeyword);

		function filterByKeyword(e) {
			listtr.forEach(tr => tr.style.display = "none");

			listOption.forEach(elt => {
				if (elt.selected) {
					listtr.forEach(tr => {
						if (tr.className.includes(elt.value))
							tr.style.display = "table-row";
					});
				}
			});
		}

		//3. direct search
		/*
		let searchName = document.getElementById("search");
		searchName.addEventListener("input", searchDocs);

		function searchDocs() {
			let saisie = keyword.value;
			if (saisie.length > 3) {
				let xmlhttp = new XMLHttpRequest();
				let url = "http://localhost/PHP/Tuto/Projet_perso/Gest_Doc/_module/search/ajax_listedocs.php?saisie=" + saisie;
				xmlhttp.open("GET", url, true);
				xmlhttp.onreadystatechange = mafonction;
				xmlhttp.send();

				function mafonction() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						selectDoc.innerHTML = xmlhttp.responseText;
						//afficheKey();
					}
				}
			}

		}
*/
	</script>
let myTable = document.getElementById("lstindex");
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
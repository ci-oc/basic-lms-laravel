function deleteRow(row)
{
    var table = document.getElementById('dataTable');
    var num_of_rows = table.rows.length;
    if (num_of_rows > 1) {
            var last_row_index = (table.rows.length)-1;
            document.getElementById('dataTable').deleteRow(last_row_index);
        }
    else
        document.getElementById('error').innerHTML = '1 test case at least required';
}

function insRow()
{
    var table=document.getElementById('dataTable');
    var new_row = table.rows[0].cloneNode(true); // copy it
    var len = table.rows.length; // 3 at first
    
    var inp1 = new_row.cells[0].getElementsByTagName('textarea')[0];
    inp1.id += len;
    inp1.value = '';
    var inp2 = new_row.cells[1].getElementsByTagName('textarea')[0];
    inp2.id += len;
    inp2.value = '';
    table.appendChild( new_row );
    document.getElementById('error').innerHTML = '';
}

/*
function addRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    if (rowCount < 50) {                            // limit the user from creating fields more than your limits
        var row = table.insertRow(rowCount);
        var colCount = table.rows[0].cells.length;
        for (var i = 0; i < colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        }
    } else {
        alert("Maximum number if test cases is 50.");

    }
}

function deleteRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    if (rowCount < 3) {                         // limit the user from removing all the fields
        alert("Minimum number of test cases is 3, Test cases +3 will be deleted");
    } else {
        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if (null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;

            }
        }
    }
}
*/
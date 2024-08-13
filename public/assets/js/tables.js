// // document.addEventListener('DOMContentLoaded', function () {
// document.getElementById('searchInput').addEventListener('input', function () {
//     const searchText = this.value.toLowerCase();
//     const rows = document.getElementById('tableBody').getElementsByTagName('tr');

//     for (let row of rows) {
//         const cells = row.getElementsByTagName('td');
//         let found = false;

//         for (let cell of cells) {
//             if (cell.textContent.toLowerCase().includes(searchText)) {
//                 found = true;
//                 break;
//             }
//         }

//         row.style.display = found ? '' : 'none';
//     }
// });
// document.addEventListener('DOMContentLoaded', function () {
//     const table = document.getElementById('datatable');
//     const tbody = document.getElementById('tableBody');
//     const ths = document.querySelectorAll('#datatable th');

//     ths.forEach((th, index) => {
//         th.addEventListener('click', () => {
//             const sortOrder = th.classList.contains('asc') ? -1 : 1;
//             const rows = Array.from(tbody.querySelectorAll('tr'));

//             rows.sort((a, b) => {
//                 const aValue = a.children[index].innerText.trim();
//                 const bValue = b.children[index].innerText.trim();

//                 if (!isNaN(parseFloat(aValue)) && !isNaN(parseFloat(bValue))) {
//                     return (parseFloat(aValue) - parseFloat(bValue)) * sortOrder;
//                 } else {
//                     return aValue.localeCompare(bValue) * sortOrder;
//                 }
//             });

//             tbody.innerHTML = '';
//             rows.forEach(row => tbody.appendChild(row));

//             ths.forEach(th => {
//                 th.classList.remove('asc', 'desc');
//             });

//             th.classList.toggle('asc', sortOrder === 1);
//             th.classList.toggle('desc', sortOrder === -1);
//         });
//     });
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const table = document.getElementById('datatable');
//     const tbody = document.getElementById('tableBody');
//     const rowsPerPage = 5;
//     let currentPage = 0;

//     function showPage(page) {
//         const rows = Array.from(tbody.querySelectorAll('tr'));
//         const startIndex = page * rowsPerPage;
//         const endIndex = startIndex + rowsPerPage;

//         rows.forEach((row, index) => {
//             row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
//         });

//         updatePaginationInfo();
//         updatePaginationButtons();
//     }

//     function updatePaginationInfo() {
//         const totalRows = tbody.querySelectorAll('tr').length;
//         const totalPages = Math.ceil(totalRows / rowsPerPage);
//         const paginationInfo = document.getElementById('paginationInfo');
//         paginationInfo.textContent = `Página ${currentPage + 1} de ${totalPages}`;
//     }

//     function updatePaginationButtons() {
//         const totalRows = tbody.querySelectorAll('tr').length;
//         const totalPages = Math.ceil(totalRows / rowsPerPage);

//         const prevButton = document.getElementById('paginationPrev');
//         const nextButton = document.getElementById('paginationNext');

//         prevButton.disabled = (currentPage === 0);
//         nextButton.disabled = (currentPage === totalPages - 1);
//     }

//     function goToPrevPage() {
//         if (currentPage > 0) {
//             currentPage--;
//             showPage(currentPage);
//         }
//     }

//     function goToNextPage() {
//         const totalRows = tbody.querySelectorAll('tr').length;
//         const totalPages = Math.ceil(totalRows / rowsPerPage);

//         if (currentPage < totalPages - 1) {
//             currentPage++;
//             showPage(currentPage);
//         }
//     }
//     function resetTable() {
//         document.getElementById('searchInput').value = "";
//         currentPage = 0;
//         showPage(currentPage);
//     }

//     document.getElementById('paginationPrev').addEventListener('click', goToPrevPage);
//     document.getElementById('paginationNext').addEventListener('click', goToNextPage);
//     document.getElementById('resetButton').addEventListener('click', resetTable);

//     showPage(currentPage);

// });
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('datatable');
    const tbody = document.getElementById('tableBody');
    const searchInput = document.getElementById('searchInput');
    const ths = document.querySelectorAll('#datatable th');
    const paginationPrev = document.getElementById('paginationPrev');
    const paginationNext = document.getElementById('paginationNext');
    const resetButton = document.getElementById('resetButton');
    const paginationInfo = document.getElementById('paginationInfo');

    const rowsPerPage = 5;
    let currentPage = 0;

    function showPage(page) {
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const startIndex = page * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
        });

        updatePaginationInfo();
        updatePaginationButtons();
    }

    function updatePaginationInfo() {
        const totalRows = tbody.querySelectorAll('tr').length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        paginationInfo.textContent = `Página ${currentPage + 1} de ${totalPages}`;
    }

    function updatePaginationButtons() {
        const totalRows = tbody.querySelectorAll('tr').length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        paginationPrev.disabled = (currentPage === 0);
        paginationNext.disabled = (currentPage === totalPages - 1);
    }

    function goToPrevPage() {
        if (currentPage > 0) {
            currentPage--;
            showPage(currentPage);
        }
    }

    function goToNextPage() {
        const totalRows = tbody.querySelectorAll('tr').length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        if (currentPage < totalPages - 1) {
            currentPage++;
            showPage(currentPage);
        }
    }

    function resetTable() {
        searchInput.value = '';
        currentPage = 0;
        showPage(currentPage);
    }

    searchInput.addEventListener('input', function () {
        const searchText = this.value.toLowerCase();
        const rows = tbody.getElementsByTagName('tr');

        for (let row of rows) {
            const cells = row.getElementsByTagName('td');
            let found = false;

            for (let cell of cells) {
                if (cell.textContent.toLowerCase().includes(searchText)) {
                    found = true;
                    break;
                }
            }

            row.style.display = found ? '' : 'none';
        }
    });

    ths.forEach((th, index) => {
        th.addEventListener('click', () => {
            const sortOrder = th.classList.contains('asc') ? -1 : 1;
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                const aValue = a.children[index].innerText.trim();
                const bValue = b.children[index].innerText.trim();

                if (!isNaN(parseFloat(aValue)) && !isNaN(parseFloat(bValue))) {
                    return (parseFloat(aValue) - parseFloat(bValue)) * sortOrder;
                } else {
                    return aValue.localeCompare(bValue) * sortOrder;
                }
            });

            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));

            ths.forEach(th => {
                th.classList.remove('asc', 'desc');
            });

            th.classList.toggle('asc', sortOrder === 1);
            th.classList.toggle('desc', sortOrder === -1);
        });
    });

    paginationPrev.addEventListener('click', goToPrevPage);
    paginationNext.addEventListener('click', goToNextPage);
    resetButton.addEventListener('click', resetTable);

    showPage(currentPage);
});

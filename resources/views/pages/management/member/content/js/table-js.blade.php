<script type="text/javascript">
    $(document).ready(function() {
        $('#table-member thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#table-member thead');
        $('#table-member').DataTable({
            orderCellsTop: true,
            initComplete: function() {
                let api = this.api();
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        if (colIdx == 6) {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            $(cell).html('@if ($institute == null)'+
                            '<button class="btn btn-primary btn-sm button cool" onclick="addInstitute()" data-bs-toggle="modal" data-bs-target="#institute" id="createInstitute">Create Institute</button>'+
                            '@else'+
                            '<button title="Create Member" class="btn-primary me-1 ms-1 btn-sm button cool btn-outline-dark hovering shadow-sm" onclick="addMember()" data-bs-toggle="modal" data-bs-target="#member" id="createMember"><i class="fa fa-plus-circle"></i></button>'+
                            '<button onclick="exportData()" title="Export Member" class="btn-success me-1 ms-1 btn-sm button cool btn-outline-dark hovering shadow-sm"><i class="fa fa-file-excel-o"></i></button>'+
                            '@endif');
                        } else if (colIdx == 0) {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            $(cell).html('');
                        } else if (colIdx == 1) {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            let title = $(cell).text();
                            $(cell).html(
                                '<input type="search" class="user form-control form-control-sm" placeholder="' +
                                title + '">');
                            $('input', $('.filters th').eq($(api.column(colIdx).header())
                                .index()))
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    let regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    let cursorPosition = this.selectionStart;
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        } else {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            let title = $(cell).text();
                            $(cell).html(
                                '<small><input class="user form-control" placeholder="' +
                                title + '"></small>'
                            );
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    let regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    let cursorPosition = this.selectionStart;
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        }
                    });
            },
            order: [
                [1, 'desc']
            ],
            processing: true,
            serverSide: true,
            searchable: true,
            lengthMenu: [
                [5, 10, 15, 30, 50, 100, -1],
                [5, 10, 15, 30, 50, 100, "All"]
            ],
            oLanguage: {
                sProcessing: '<button class="btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span></button>',
                sSearch: '<span class=""><i class="btn-outline-primary hovering fa fa-search"></i></span>',
                sSearchPlaceholder: 'Search All...',
                sZeroRecords: '<span class="badge badge-light-danger"></i><p>Kata kunci salah</p></span>',
                sEmptyTable: '<span class="badge badge-light-danger"></i><p>Tidak ada data</p></span>',
                sLengthMenu: '<i class="btn-outline-primary hovering fa fa-th-list"></i> _MENU_ ',
                sInfo: '<span class="btn badge-light-primary">_START_ to _END_ of _TOTAL_ <i class="fa fa-user"></i></span>',
                sInfoEmpty: '<span class="btn badge-light-primary"><i class="fa fa-eye"></i> 0 to 0 of 0 <i class="fa fa-user"></i></span>',
                sInfoFiltered: '<span class="badge badge-light-primary">from _MAX_ <i class="fa fa-users"></i></span>',
                oPaginate: {
                    sFirst: "First",
                    sLast: "Last",
                    sNext: '>',
                    sPrevious: '<',
                },
            },
            ajax: "{{ route('management.member.table') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'get_user.name',
                    name: 'name'
                },
                {
                    data: 'get_user.email',
                    name: 'email'
                },
                {
                    data: 'info',
                    name: 'info'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'ip',
                    name: 'ip'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>

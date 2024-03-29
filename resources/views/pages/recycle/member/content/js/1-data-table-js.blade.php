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
                        if (colIdx == 0) {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            $(cell).html('');
                        } else if (colIdx == 4) {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            $(cell).html('');
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
                                    $(this).attr('title', $(this).val());
                                    let regexr =
                                        '({search})';

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
                [3, 'desc']
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
                sZeroRecords: '<span class="badge badge-light-danger">Kata kunci salah</span>',
                sEmptyTable: '<span class="badge badge-light-danger"><span>Tidak ada data</span></span>',
                sLengthMenu: '<i class="btn-outline-primary hovering fa fa-th-list"></i> _MENU_ ',
                sInfo: '<span class="btn badge-light-primary"><i class="fa fa-folder-open"></i> _START_ to _END_ of _TOTAL_ <i class="fa fa-file-text"></i></span>',
                sInfoEmpty: '<span class="btn badge-light-primary"><i class="fa fa-folder"></i> 0 to 0 of 0 <i class="fa fa-file"></i></span>',
                sInfoFiltered: '<span class="badge badge-light-primary">from _MAX_ <i class="fa fa-file-text"></i></span>',
                oPaginate: {
                    sFirst: "First",
                    sLast: "Last",
                    sNext: '>',
                    sPrevious: '<',
                },
            },
            ajax: "{{ route('recycle.member.request') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                    render: function(data) {
                        return '<div class="text-primary text-center">' + data + '.' +
                            '</div>';
                    },
                },
                {
                    data: 'member',
                    name: 'member'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'info',
                    name: 'info'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
        $('tbody').on('click', '.read-more', function () {
            $(this).closest('.short-text').hide();
            $(this).closest('.short-text').next('.full-text').show();
        });

        $('tbody').on('click', '.read-less', function () {
            $(this).closest('.full-text').hide();
            $(this).closest('.full-text').prev('.short-text').show();
        });

        $('tbody').on('draw.dt', function () {
            $('.full-text').hide();
            $('.read-less').hide();
        });
    });

</script>

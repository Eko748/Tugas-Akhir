<script type="text/javascript">
    $(document).ready(function() {
        $('#table-project thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#table-project thead');
        $('#table-project').DataTable({
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
                            $(cell).html(
                                '<a href="{{ Auth::user()->role_id == 1 ? route('management.project.export') : route('project.export') }}" title="Export Project ke Excel" class="text-center review-go btn-success hovering"><i class="fa fa-download"></i></a>');
                        } else if (colIdx == 7) {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            $(cell).html(
                                '<a href="{{ Auth::user()->role_id == 1 ? route('review.master.index') : route('review.index') }}" title="Go To Review" class="text-center review-go btn btn-primary hovering"><i class="fa fa-plus-circle"></i></a>'
                                );
                        } else if (colIdx == 3) {
                            let cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            let title = $(cell).text();
                            $(cell).html(
                                '<small><input type="search" class="user form-control form-control-sm" placeholder="' +
                                title + '"></small>');
                            $('input', $('.filters th').eq($(api.column(colIdx).header())
                                .index()))
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
                [6, 'desc']
            ],
            processing: true,
            serverSide: true,
            searchable: true,
            lengthMenu: [
                [5, 10, 15, 30, 50, 100, 150, 300],
                [5, 10, 15, 30, 50, 100, 150, 300]
            ],
            oLanguage: {
                sProcessing: '<button class="btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span></button>',
                sSearch: '<span class=""><i class="btn-outline-primary hovering fa fa-search"></i></span>',
                sSearchPlaceholder: 'Search All...',
                sZeroRecords: '<span class="badge badge-light-danger"></i>Kata kunci salah</span>',
                sEmptyTable: '<span class="badge badge-light-danger"></i><span>Tidak ada data</span></span>',
                sLengthMenu: '<i class="btn-outline-primary hovering fa fa-th-list"></i> _MENU_ ',
                sInfo: '<span class="btn badge-light-primary"><i class="fa fa-folder-open"></i> _START_ to _END_ of _TOTAL_ <i class="fa fa-file-text"></i></span>',
                sInfoEmpty: '<span class="btn badge-light-primary"><i class="fa fa-folder-open"></i> 0 to 0 of 0 <i class="fa fa-file-text"></i></span>',
                sInfoFiltered: '<span class="badge badge-light-primary">from _MAX_ <i class="fa fa-file-text"></i></span>',
                oPaginate: {
                    sFirst: "First",
                    sLast: "Last",
                    sNext: '>',
                    sPrevious: '<',
                },
            },
            ajax: "{{ Auth::user()->role_id == 1 ? route('management.project.getTable') : route('project.getTable') }}",
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
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'article',
                    name: 'article',
                    render: function (data, type, row) { 
                            if (data.split(' ').length > 3) {
                            var short_text = data.split(' ').slice(0,3).join(' ') + '...  ';
                            var full_text = data;
                            return '<div class="short-text">' + short_text + '<a href="#" class="read-more">  <small><i class="fa fa-chevron-circle-right""></i></small></a></div><div class="full-text" style="display: none;">' + full_text + '<a href="#" class="read-less">  <small><i class="fa fa-chevron-circle-left"></i></small></a></div>';
                        } else {
                            return data;
                        }
                    },
                },
                {
                    data: 'abstracts',
                    name: 'abstracts',
                    render: function (data, type, row) { 
                            if (data.split(' ').length > 3) {
                            var short_text = data.split(' ').slice(0,3).join(' ') + '...  ';
                            var full_text = data;
                            return '<div class="short-text">' + short_text + '<a href="#" class="read-more">  <small><i class="fa fa-chevron-circle-right""></i></small></a></div><div class="full-text" style="display: none;">' + full_text + '<a href="#" class="read-less">  <small><i class="fa fa-chevron-circle-left"></i></small></a></div>';
                        } else {
                            return data;
                        }
                    },
                },
                {
                    data: 'year',
                    name: 'year'
                },
                {
                    data: 'authors',
                    name: 'authors',
                    render: function (data, type, row) { 
                            if (data.split(' ').length > 3) {
                            var short_text = data.split(' ').slice(0,3).join(' ') + '...  ';
                            var full_text = data;
                            return '<div class="short-text">' + short_text + '<a href="#" class="read-more">  <small><i class="fa fa-chevron-circle-right""></i></small></a></div><div class="full-text" style="display: none;">' + full_text + '<a href="#" class="read-less">  <small><i class="fa fa-chevron-circle-left"></i></small></a></div>';
                        } else {
                            return data;
                        }
                    },
                },
                {
                    data: 'info',
                    name: 'info',
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

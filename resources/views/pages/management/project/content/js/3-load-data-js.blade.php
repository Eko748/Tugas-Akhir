<script type="text/javascript">
    let lastHomeTabPage = 1;
    let lastDoingTabPage = 1;
    let lastDoneTabPage = 1;

    function resetPage(tab) {
        if (tab === 'home') {
            lastHomeTabPage = 1;
            $('#project-load .pagination a').each(function() {
                let href = $(this).attr('href');
                let newHref = href.split('page=')[0] + 'page=1';
                $(this).attr('href', newHref);
            });
        } else if (tab === 'doing') {
            lastDoneTabPage = 1;
            $('#doing-load .pagination a').each(function() {
                let href = $(this).attr('href');
                let newHref = href.split('page=')[0] + 'page=1';
                $(this).attr('href', newHref);
            });
        } else if (tab === 'done') {
            lastDoneTabPage = 1;
            $('#done-load .pagination a').each(function() {
                let href = $(this).attr('href');
                let newHref = href.split('page=')[0] + 'page=1';
                $(this).attr('href', newHref);
            });
        }
    }

    $('#top-home-tab, #top-doing-tab, #top-done-tab').on('click', function() {
        let tab = $(this).attr('id').split('-')[1];
        resetPage(tab);
    });

    $('#top-home-tab').on('click', function() {
        $('#project-load').show();
        $('#doing-load').hide();
        $('#done-load').hide();
        getData(lastHomeTabPage, 'projects');
    });

    $(document).on('click', '#project-load .pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        lastHomeTabPage = page;
        let type = 'projects';
        getData(page, type);
    });

    $('#top-doing-tab').on('click', function() {
        $('#doing-load').show();
        $('#done-load').hide();
        $('#project-load').hide();
        getData(lastDoingTabPage, 'done');
    });

    $(document).on('click', '#doing-load .pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        lastDoingTabPage = page;
        let type = 'doing';
        getData(page, type);
    });

    $('#top-done-tab').on('click', function() {
        $('#done-load').show();
        $('#doing-load').hide();
        $('#project-load').hide();
        getData(lastDoneTabPage, 'done');
    });

    $(document).on('click', '#done-load .pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        lastDoneTabPage = page;
        let type = 'done';
        getData(page, type);
    });

    function getData(page, type) {
        $.ajax({
            type: "GET",
            data: {},
            url: "{{ Auth::user()->role_id == 1 ? route('management.project.index') : route('project.index') }}" +
                "?page=" + page + "&type=" + type,
            success: function(data) {
                if (type == 'projects') {
                    $('#project-load').html(data);
                } else if (type == 'doing') {
                    $('#doing-load').html(data);
                } else if (type == 'done') {
                    $('#done-load').html(data);
                }
            }
        });
    }
</script>

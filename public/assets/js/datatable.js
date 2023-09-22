
$(function () {
    var dateFormat = 'DD-MM-YYYY';
    var $table1 = $('#profile_list_table');
    let startDate;
    let endDate;

    jQuery(
        'input.bootstrap-table-filter-control-created_at[type="search"],input.bootstrap-table-filter-control-updated_at[type="search"]'
    ).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format(dateFormat) + ' - ' + picker.endDate.format(dateFormat));
        if ($('#profile_list_table').attr('data-side-pagination')) {
            setTimeout(() => {
                $(this).trigger('keyup');
            }, 100);
        }

        $(this).val(picker.startDate.format(dateFormat) + ' - ' + picker.endDate.format(dateFormat));
    });

    $(
        'input.bootstrap-table-filter-control-created_at[type="search"],input.bootstrap-table-filter-control-updated_at[type="search"]'
    ).on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
        $(this).data('daterangepicker').setStartDate(moment().format(dateFormat)); //date now
        $(this).data('daterangepicker').setEndDate(moment().format(dateFormat)); //date now
        $table1.bootstrapTable('filterBy', {});
    });
    
    $('input.bootstrap-table-filter-control-created_at[type="search"]')
        .daterangepicker(
            {
                autoUpdateInput: false,
                locale: {
                    format: dateFormat,
                    separator: ' - ',
                    firstDay: 1
                },
                opens: 'left'
            },
            function (start, end) {
                startDate = start.format('DD-MM-YYYY');
                endDate = end.format(dateFormat);
                let dates = [startDate, endDate];
                filterByDate(dates, 'created_at');
                $('input.bootstrap-table-filter-control-created_at[type="search"]').val(
                    start.format(dateFormat) + ' - ' + end.format(dateFormat)
                );
                console.log(startDate + ' ' + endDate);
            }
        )
        .change(function () {
            let dates = [startDate, endDate];
            filterByDate(dates, 'created_at');
        });

    $('input.bootstrap-table-filter-control-updated_at[type="search"]')
        .daterangepicker(
            {
                autoUpdateInput: false,
                locale: {
                    format: dateFormat,
                    separator: ' - ',
                    firstDay: 1
                },
                opens: 'left'
            },
            function (start, end) {
                startDate = start.format(dateFormat);
                endDate = end.format(dateFormat);
                let dates = [startDate, endDate];
                filterByDate(dates, 'updated_at');
                $('input.bootstrap-table-filter-control-updated_at[type="search"]').val(
                    start.format(dateFormat) + ' - ' + end.format(dateFormat)
                );
            }
        )
        .change(function () {
            let dates = [startDate, endDate];
            filterByDate(dates, 'updated_at');
        });
});

function filterByDate(dates, columnName) {
    var dateFormat = 'DD-MM-YYYY';
    if ($('#profile_list_table').attr('data-side-pagination')) {
        return '';
    } else {
        var $table1 = $('#profile_list_table');
        var enumerateDaysBetweenDates = function (startDate, endDate) {
            var now = startDate,
                dates = [];

            while (now.isSameOrBefore(endDate)) {
                dates.push(now.format(dateFormat));
                now.add(1, 'days');
            }
            return dates;
        };
        dateResults = enumerateDaysBetweenDates(moment(dates[0], dateFormat), moment(dates[1], dateFormat));
        var filterData = {
            [columnName]: dateResults
        };
        $table1.bootstrapTable('filterBy', filterData);
    }
}
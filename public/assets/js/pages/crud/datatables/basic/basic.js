"use strict";
var KTDatatablesBasicBasic = function () {

    var initTable1 = function () {
        var table = $('#kt_datatable');

        // begin first table
        table.DataTable({
            responsive: true,

            // DOM Layout settings
            dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            language: {
                'lengthMenu': 'Display _MENU_',
            },

            // Order settings
            order: [[0, 'asc']],

            // headerCallback: function(thead, data, start, end, display) {
            // 	thead.getElementsByTagName('th')[0].innerHTML = display;
            // },

            columnDefs: [
                // {
                // 	targets: 0,
                // 	width: '30px',
                // 	className: 'dt-left',
                // 	orderable: false,
                // 	render: function(data, type, full, meta) {
                // 		return data;
                // 	},
                // },
                {
                    targets: -1,
                    title: 'Действия',
                    orderable: false,
                    width: '50px',
                    render: function (data, type, full, meta) {
                        return '\
	                        <a href="' + data + '" class="btn btn-sm btn-clean btn-icon mr-2" title="Редактировать">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                        <rect x="0" y="0" width="24" height="24"/>\
	                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
	                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
	                                    </g>\
	                                </svg>\
	                            </span>\
	                        </a>\
	                    ';
                    },
                },
                {
                    targets: 3,
                    width: '75px',
                    render: function (data) {
                        var status = {
                            1: {'title': 'Доступна', 'class': ' label-light-primary'},
                            0: {'title': 'Скрыта', 'class': ' label-light-warning'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    },
                },
                // {
                //     targets: 8,
                //     width: '75px',
                //     render: function (data, type, full, meta) {
                //         var status = {
                //             0: {'title': 'Обычная', 'class': 'label-light-primary'},
                //             1: {'title': 'Обычная', 'class': ' label-light-primary'},
                //             2: {'title': 'Стандартная', 'class': ' label-light-primary'},
                //             3: {'title': 'Мастер', 'class': ' label-light-primary'},
                //             4: {'title': 'Продвинутая', 'class': ' label-light-warning'},
                //         };
                //         if (typeof status[data] === 'undefined') {
                //             return data;
                //         }
                //         return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                //     },
                // },
                // {
                //     targets: 9,
                //     width: '75px',
                //     render: function (data, type, full, meta) {
                //         var status = {
                //             0: {'title': 'Активен', 'state': 'primary'},
                //             1: {'title': 'Заблокирован', 'state': 'danger'},
                //             2: {'title': 'Retail', 'state': 'primary'},
                //             3: {'title': 'Direct', 'state': 'success'},
                //         };
                //         if (typeof status[data] === 'undefined') {
                //             return data;
                //         }
                //         return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
                //             '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
                //     },
                // },
            ],
        });

        table.on('change', '.group-checkable', function () {
            var set = $(this).closest('table').find('td:first-child .checkable');
            var checked = $(this).is(':checked');

            $(set).each(function () {
                if (checked) {
                    $(this).prop('checked', true);
                    $(this).closest('tr').addClass('active');
                } else {
                    $(this).prop('checked', false);
                    $(this).closest('tr').removeClass('active');
                }
            });
        });

        table.on('change', 'tbody tr .checkbox', function () {
            $(this).parents('tr').toggleClass('active');
        });
    };

    return {

        //main function to initiate the module
        init: function () {
            initTable1();
        }
    };
}();

jQuery(document).ready(function () {
    KTDatatablesBasicBasic.init();
});

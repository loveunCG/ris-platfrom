
<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            <?=$menutitle?>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <?=$menutitle?>
                        </a>
                        <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>资料共享</span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="row" id="sortable_portlets">
            <div class="col-md-12 column sortable">
                <div class="portlet portlet-sortable box blue-chambray">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-green sbold uppercase">资料共享</span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div id="elfinder"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(function () {
        $('#elfinder').elfinder(
            {
                cssAutoLoad: false, // Disable CSS auto loading
                baseUrl: '<?=base_url()?>/assets/elfinder/', // Base URL to css/*, js/*
                url: '../assets/elfinder/php/connector.minimal.php' ,
                lang : 'zh_CN'// connector URL (REQUIRED)
            },
            function (fm, extraObj) {
                fm.bind('init', function () {
                    delete fm.options.rawStringDecoder;
                    if (fm.lang === 'jp') {
                        fm.loadScript(
                            [fm.baseUrl + 'js/extras/encoding-japanese.min.js'],
                            function () {
                                if (window.Encoding && Encoding.convert) {
                                    fm.options.rawStringDecoder = function (s) {
                                        return Encoding.convert(s, {
                                            to: 'UNICODE',
                                            type: 'string'
                                        });
                                    };
                                }
                            }, {
                                loadType: 'tag'
                            }
                        );
                    }
                });
                var title = document.title;
                fm.bind('open', function () {
                    var path = '',
                        cwd = fm.cwd();
                    if (cwd) {
                        path = fm.path(cwd.hash) || null;
                    }
                    document.title = path ? path + ':' + title : title;
                }).bind('destroy', function () {
                    document.title = title;
                });
            }
        );
    });
</script>
<div class="container" ng-init="application.getCourse(<?= $param; ?>);">
    <div class="row m-t-05">
        <div class="col-sm-9">


            <div class="row m-b-05 border-ash background-white-complete  p-t-10 p-r-05 p-l-05 p-b-10">

                <div class="col-sm-12">
                    <h3 class="col-sm-7 m-t-00 m-b-00 p-t-05 p-l-00"><span ng-bind="application.course.course_name"></span></h3>
                    <div class="col-sm-5 p-r-00 btn-group btn-xm p-l-00 m-b-10 m-t-10" >
                        <div class="pull-right">
                            <span ng-class="(!(application.inCart)) ? 'hidden': 'btn btn-info btn-sm font-12'" ng-show="application.inCart" ng-bind="'Course In Cart'"></span>
                            <span ng-class="(!application.course.applyable && application.inCart)? 'hidden': 'btn btn-sm btn-default font-12'" ng-show="application.course.applyable && !application.inCart" ng-click="application.addToCart(application.course)"><i class="fa fa-shopping-bag"></i>&nbsp;&nbsp; add to cart</span>
                            <a ng-class="(!(application.course.applyable)) ? 'hidden' : 'btn btn-sm btn-success font-12'" ng-show="application.course.applyable" href="<?= base_url('users/checkout'); ?>"><i class="fa fa-thumbs-up"></i> &nbsp;&nbsp;checkout</a>
                            <div ng-show="!application.course.applyable" ng-class="(application.course.applyable) ? 'hidden': 'pull-right btn btn-danger btn-sm font-12'" ng-bind="'Applications Closed'"></div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-12 p-b-10">
                    <span class="font-14 text-blue" ng-click="application.tap()" ng-bind="application.course.school_name"></span>
                </div>

                <div class="col-sm-12 font-14 text-purple">
                    <div class="col-sm-3 p-l-00 text-left" ng-bind="application.course.local | currency: ' <?= NGN; ?>': 2 ">
                        (Local)
                    </div>
                    <div class="col-sm-3 p-l-00 text-left" ng-bind="application.course.intl | currency: ' $': 2 ">
                        (International)
                    </div>
                    <div class="col-sm-2 p-l-00 text-left">
                        <i class="fa fa-clock-o"></i>
                        <span><?= $discipline->duration; ?></span>
                    </div>
                    <div class="col-sm-2 p-l-00">
                        <i class="fa fa-home"></i>
                        <span><?= $discipline->deliver_mode_name; ?></span>
                    </div>
                </div>

                <div class="col-sm-12">
                    <h4>Description</h4>
                </div>

                <div class="col-sm-12">
                    <p class="text-justify">
                        <?= base64_decode($discipline->description); ?>
                    </p>
                </div>

            </div>

            <div class="row m-b-05 border-ash background-white-complete  p-t-10 p-r-05 p-l-05 p-b-10">
                <div class="col-sm-12">
                    <h4 class="text-blue m-b-10">Details</h4>

                    <h4 class="bold">Course Content</h4>
                    <div class="text-justify">
                        <?= base64_decode($discipline->content); ?>
                    </div>
                </div>	
            </div>

            <div class="row m-b-05 border-ash background-white-complete  p-t-10 p-r-05 p-l-05 p-b-10">
                <div class="col-sm-12">
                    <h4 class="text-blue">Requirements</h4>
                    <h4 class="bold">Admission Requirements</h4>
                    <div class="text-justify">
                        <?= base64_decode($discipline->adm_experience); ?>
                    </div>
                    <h4 class="bold">Work Experience Requirements</h4>
                    <div class="text-justify">
                        <?= base64_decode($discipline->work_experience); ?>
                    </div>
                </div>	
            </div>

			<!--
            <div class="row m-b-05 border-ash background-white-complete  p-t-10 p-r-05 p-l-05 p-b-10">
                <div class="col-sm-12">
                    <h4 class="text-blue">Scholarships</h4>
                    <div class="col-sm-12 padding-00">
                        <div class="col-sm-6 p-l-00">
                            <h5 class="text-green">Dangote Scholarship</h5>
                            <p class="text-justify">
                                Suspendisse hendrerit erat in dui congue ullamcorper. Ut accumsan urna nec gravida facilisis. Duis accumsan purus ut orci varius ultricies. In tempor commodo nibh ut consectetur. Vestibulum ultricies purus non nulla congue, et iaculis est laoreet. Donec ac lorem cursus, laoreet mi ac, finibus nisl. In consectetur, est non sagittis mollis, tortor mauris ultricies augue, in feugiat ipsum lectus ut metus. Praesent sed libero ultrices, pharetra lorem ac, blandit nisi. Maecenas ultricies, risus a porttitor tempus, nulla mi tempus erat, vitae consequat nisl turpis vitae tortor. Integer ligula turpis, venenatis ut volutpat accumsan, viverra quis est. Phasellus id augue a elit ullamcorper iaculis non nec purus. Sed et erat laoreet, faucibus dui eu, bibendum mi. Curabitur vel urna ut neque sagittis eleifend. Nullam faucibus nulla nec dolor scelerisque scelerisque. Curabitur quis ligula eros.
                            </p>
                            <div class="">
                                <a class="btn btn-default" href="<?= base_url('#'); ?>">read more...</a>
                            </div>
                        </div>

                        <div class="col-sm-6 p-r-00">
                            <h5 class="text-green">Dangote Scholarship</h5>
                            <p class="text-justify">
                                Suspendisse hendrerit erat in dui congue ullamcorper. Ut accumsan urna nec gravida facilisis. Duis accumsan purus ut orci varius ultricies. In tempor commodo nibh ut consectetur. Vestibulum ultricies purus non nulla congue, et iaculis est laoreet. Donec ac lorem cursus, laoreet mi ac, finibus nisl. In consectetur, est non sagittis mollis, tortor mauris ultricies augue, in feugiat ipsum lectus ut metus. Praesent sed libero ultrices, pharetra lorem ac, blandit nisi. Maecenas ultricies, risus a porttitor tempus, nulla mi tempus erat, vitae consequat nisl turpis vitae tortor. Integer ligula turpis, venenatis ut volutpat accumsan, viverra quis est. Phasellus id augue a elit ullamcorper iaculis non nec purus. Sed et erat laoreet, faucibus dui eu, bibendum mi. Curabitur vel urna ut neque sagittis eleifend. Nullam faucibus nulla nec dolor scelerisque scelerisque. Curabitur quis ligula eros.
                            </p>
                            <div class="">
                                <a class="btn btn-default" href="<?= base_url('#'); ?>">read more...</a>
                            </div>
                        </div>						
                    </div>
                </div>	
            </div>
			-->
        </div>

        <aside class="col-sm-3 p-l-05">

            <div class="row background-white-complete m-l-00 p-t-05 p-b-05">
                <div class="col-sm-12">
                    <h4>Related Results (<span ng-bind="application.course.related.related.length"></span>)</h4>
                </div>


                <div class="col-sm-12 p-t-10 p-b-10" style="border-top: 1px solid #f2f2f2;" ng-repeat="related in application.course.related.related">
                    <div class="col-sm-3 background-image height-x-50 border-5r background-70" ng-style="{'background-image': 'url({{related.school_logo}})'}"></div>
                    <a ng-href="<?= base_url('users/discipline/'); ?>/{{related.id}}">
                        <div class="col-sm-9 text-black">
                            <div class="col-sm-12 p-t-00 p-r-00 p-l-00 p-b-00">
                                <h4 class="m-r-00 m-l-00 m-t-00 m-b-00"><span ng-bind="related.school_name"></span></h4>
                            </div>
                            <div class="col-sm-12 p-t-00 p-r-00 p-l-00 p-b-00">
                                <small ng-bind="related.name"></small>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <div class="row">

            </div>

            <div class="row">

            </div>
        </aside>
    </div>
</div>
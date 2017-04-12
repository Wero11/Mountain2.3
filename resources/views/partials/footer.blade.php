 </div>
</div>
<!-- /Main -->
<script src="{{ asset('/public/js/lib/vue.min.js') }}"></script>
<script src="{{ asset('/public/js/lib/vue-resource.min.js') }}"></script>
<script src="{{ asset('/public/js/site/app.js') }}"></script>
<script src="{{ asset('/public/js/site/common.js') }}"></script>

<script src="{{ asset('/public/js/lib/jquery.validate.js') }}"></script>
<script src="{{ asset('/public/js/site/mountain.js') }}"></script>
<script src="{{ asset('/public/js/site/judge.js') }}"></script>
<script src="{{ asset('/public/js/site/login.js') }}"></script>
<script src="{{ asset('/public/js/site/notification.js') }}"></script>
<script src="{{ asset('/public/js/site/rolesettings.js') }}"></script>
<script src="{{ asset('/public/js/site/user.js') }}"></script>




<script>
(function() {
    jQuery('#country_id option').filter(function() {
        alert(this.value);
        return this.value === '15';
    }).prop('selected', true);
});
</script>
<footer class="page-footer text-center">
Copyrights reserved 2015,Invigor Group Limited (Australia)

</footer>

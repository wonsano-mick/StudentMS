{{-- Footer --}}
{{-- Copyright --}}
<footer class="page-footer font-small">
    <div class="footer-copyright black text-center text-white-50 py-3">
        <a href="{{ route('contact.index') }}" class="text-white-50">
            <p class="lead text-center">Designed By | Wonsano | 2020 - <span><?php echo date('Y'); ?></span>&copy; ...All
                Rights
                Reserved</p>
        </a>
    </div>
</footer>
{{-- Copyright --}}
{{-- End of Footer --}}

</div>
{{-- End of Content Wrapper --}}

</div>
{{-- End of Page Wrapper --}}
{{-- Scroll Back Button Starts --}}
<a class="scroll-to-top" href="#page-top">&#10148</a>
{{-- Scroll Back Button Ends --}}

{{-- Logout Modal --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger no-underline hover:underline" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i
                        class="fas fa-fw fa-power-off"></i><span> Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>

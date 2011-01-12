            <?php do_action( 'bp_after_container' ) ?>
            <?php do_action( 'bp_before_footer' ) ?>
            
            <div id="footer-container" class="clearfix">
                <div id="footer">
                    This is footer.
                    
                    <?php do_action( 'bp_footer' ) ?>
                </div>
            </div>
        </div> <!-- #wrapper -->
        <?php do_action( 'bp_after_footer' ) ?>
        <?php wp_footer(); ?>
	</body>
</html>
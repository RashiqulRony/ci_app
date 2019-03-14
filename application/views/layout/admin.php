<?php $this->load->view('layout/page_header'); ?>
<body class="nav-md">
    <div class="container body">
		<div class="main_container">
			<?php $this->load->view('layout/page_sitebar'); ?>
			<?php $this->load->view($subview); ?>
		</div>
    </div>

    <?php $this->load->view('layout/page_footer'); ?>
    </body>
</html>

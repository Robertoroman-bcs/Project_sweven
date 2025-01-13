  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
      </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
$.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/moment/moment.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script
      src="<?php echo $URL ?>/src/public/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
  </script>
  <!-- Summernote -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
  </script>
  <!-- AdminLTE App -->
  <script src="<?php echo $URL ?>/src/public/template/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo $URL ?>/src/public/template/dist/js/pages/dashboard.js"></script>
  <!-- Select2 -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/select2/js/select2.full.min.js"></script>
  <script>
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});
  </script>
  <!-- DataTables  & Plugins -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-responsive/js/dataTables.responsive.min.js">
  </script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
  </script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
  </script>
  <script>

  </script>
  </body>

  </html>
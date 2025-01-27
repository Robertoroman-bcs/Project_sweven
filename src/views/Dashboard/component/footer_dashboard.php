  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <strong>Copyright &copy; 2024-2025 <a href="https://adminlte.io">SWEVEN ADVISOR</a>.</strong>

      <div class="float-right d-none d-sm-inline-block">
          <b>Todos los derechos reservados.</b>
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
  <!-- InputMask -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/moment/moment.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/inputmask/jquery.inputmask.min.js"></script>

  <script>
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
          theme: 'bootstrap4'
      })
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
          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', {
              'placeholder': 'dd/mm/yyyy'
          })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('mm/dd/yyyy', {
              'placeholder': 'mm/dd/yyyy'
          })
          //Money Euro
          $('[data-mask]').inputmask()

          //Date picker
          $('#reservationdate').datetimepicker({
              format: 'L'
          });

          //Date and time picker
          $('#reservationdatetime').datetimepicker({
              icons: {
                  time: 'far fa-clock'
              }
          });

          //Date range picker
          $('#reservation').daterangepicker()
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({
              timePicker: true,
              timePickerIncrement: 30,
              locale: {
                  format: 'MM/DD/YYYY hh:mm A'
              }
          })
          //Date range as a button
          $('#daterange-btn').daterangepicker({
                  ranges: {
                      'Today': [moment(), moment()],
                      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                      'This Month': [moment().startOf('month'), moment().endOf('month')],
                      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                          .endOf('month')
                      ]
                  },
                  startDate: moment().subtract(29, 'days'),
                  endDate: moment()
              },
              function(start, end) {
                  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
              }
          )

          //Timepicker
          $('#timepicker').datetimepicker({
              format: 'LT'
          })
      });
  </script>
  <script>

  </script>
  </body>

  </html>
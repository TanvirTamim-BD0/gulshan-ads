$(function() {
	"use strict";

  $(document).ready(function() {
    $('.example').DataTable();
  } );

    $(document).ready(function() {
        $('#example').DataTable();
      } );

    $(document).ready(function() {
        $('#example1').DataTable();
      } );

    $(document).ready(function() {
        $('#example5').DataTable();
      } );

    $(document).ready(function() {
        $('#example6').DataTable();
      } );

    $(document).ready(function() {
        $('#example7').DataTable();
      } );

    $(document).ready(function() {
        $('#example8').DataTable();
      } );

    $(document).ready(function() {
        $('#example9').DataTable();
      } );


      $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
     
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );


});
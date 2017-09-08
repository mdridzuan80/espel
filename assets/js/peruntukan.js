$('#txtTkhWaran').daterangepicker({
  singleDatePicker: true,
  singleClasses: "picker_4",
  locale: {
      format: 'DD-MM-YYYY'
    },
}, function(start, end, label) {
  console.log(start.toISOString(), end.toISOString(), label);
});

$(document).ready(function(){var i,e=function(){$("#sparkline1").sparkline([34,43,43,35,44,32,44,52],{type:"line",width:"100%",height:"60",lineWidth:2,lineColor:"#ff4081",fillColor:"#ffffff"}),$("#sparkline2").sparkline([24,43,43,55,44,62,44,72],{type:"line",width:"100%",height:"60",lineWidth:2,lineColor:"#ff4081",fillColor:"#ffffff"}),$("#sparkline3").sparkline([74,43,23,55,54,32,24,12],{type:"line",width:"100%",height:"60",lineWidth:2,lineColor:"#6610f2",fillColor:"#ffffff"}),$("#sparkline4").sparkline([24,43,33,55,64,72,44,22],{type:"line",width:"100%",height:"60",lineWidth:2,lineColor:"#6610f2",fillColor:"#ffffff"}),$("#sparkline5").sparkline([1,4],{type:"pie",height:"140",sliceColors:["#ff4081","#F5F5F5"]}),$("#sparkline6").sparkline([5,3],{type:"pie",height:"140",sliceColors:["#ff4081","#F5F5F5"]}),$("#sparkline7").sparkline([2,2],{type:"pie",height:"140",sliceColors:["#6610f2","#F5F5F5"]}),$("#sparkline8").sparkline([2,3],{type:"pie",height:"140",sliceColors:["#6610f2","#F5F5F5"]})};$(window).resize(function(l){clearTimeout(i),i=setTimeout(e,500)}),e()});
<!DOCTYPE html>
<meta charset="utf-8">
<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
<style>
.bar {
  fill: steelblue;
}
.bar:hover {
  fill: brown;
}
.axis--x path {
  display: none;
}
</style>
<svg width="960" height="500"></svg>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>
var svg = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom;
var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
    y = d3.scaleLinear().rangeRound([height, 0]);
var g = svg.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
d3.tsv("./data.php?action=<?php echo $_GET[action];?>", function(d) {
  d.frequency = +d.frequency;
  return d;
}, function(error, data) {
  if (error) throw error;
  x.domain(data.map(function(d) { return d.letter; }));
  y.domain([0, d3.max(data, function(d) { return d.frequency; })]);
  g.append("g")
      .attr("class", "axis axis--x")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x));
  g.append("g")
      .attr("class", "axis axis--y")
      .call(d3.axisLeft(y).ticks(10, "%"))
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", "0.71em")
      .attr("text-anchor", "end")
      .text("Frequency");
  g.selectAll(".bar")
    .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.letter); })
      .attr("y", function(d) { return y(d.frequency); })
      .attr("width", x.bandwidth())
      .attr("height", function(d) { return height - y(d.frequency); });
});
</script>
<br>
<a href="./viz.php?action=profit">By Profit</a> <br>
<a href="./viz.php?action=month_2017">By Monthly Order in 2017</a> <br>
<a href="./viz.php?action=annual">By Annual Order in All Years</a> <br>
<br>
<form name="exportData" action="export.php" method="POST">
			<input type="button" class="btn" value="Export Monthly Order Data in 2017" onClick="window.location.href='export.php?id=1'">
			<input type="button" class="btn" value="Export Annual Order Data in All Years" onClick="window.location.href='export.php?id=2'">
			<input type="button" class="btn" value="Export Individual Book Profit in All Years" onClick="window.location.href='export.php?id=3'">
</form>	
<?php
    session_start();
	$id=$_SESSION['id'];
	echo "<a href='/book_sales/admin/admin.php'>back</a>";
?>
</center>
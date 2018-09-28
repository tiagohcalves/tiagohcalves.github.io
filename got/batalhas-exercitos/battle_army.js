var margin = {top: 50, right: 20, bottom: 10, left: 160},
    width = 800 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var y = d3.scale.ordinal()
    .rangeRoundBands([0, height], .3);

var x = d3.scale.linear()
    .rangeRound([0, width]);

var color = d3.scale.ordinal()
    .range(["#086fad", "#c7001e"]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("top");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

var tip_battle = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    return "<strong>King:</strong> <span style='color:cyan'>" + d.king + "</span><br>" +
           "<strong>Commanders:</strong> <span style='color:cyan'>" + d.commander + "</span><br>" +
           "<string>Army size: <span style='color:cyan'>" + d.size + "</span><br>" + 
           "<string>Outcome: <span style='color:cyan'>" + d.outcome + "</span><br>";
  });

var svg = d3.select("#battle-army").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .attr("id", "d3-plot")
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  svg.call(tip_battle);

  color.domain(["Defender Size", "Attacker Size"]);

  var sortByName = function(a,b){
      if(a.name < b.name) return -1;
      if(a.name > b.name) return 1;
      return 0;
  }

  var sortByAttacker = function(a,b){
      return b.attacker_size - a.attacker_size;
  }

  var sortByDefender = function(a,b){
      return b.defender_size - a.defender_size;
  }

  var sortByBoth = function(a,b){
      return (b.attacker_size + b.defender_size) - (a.attacker_size + a.defender_size);
  }

  var current_battle_data = battle_data;
  current_battle_data.sort(sortByName);

  current_battle_data.forEach(function(d) {
    d["Attacker Size"] = +d["attacker_size"];
    d["Defender Size"] = +d["defender_size"];
    var x0 = -1*(d["Defender Size"]);
    var idx = 0;
    d.boxes = color.domain().map(function(name) { return {
      name: name, 
      x0: x0, 
      x1: x0 += +d[name], 
      N: 2, 
      king: x0 > 0 ? d.attacker_king : d.defender_king,
      commander: x0 > 0 ? d.attacker_commander : d.defender_commander,
      size: x0 > 0 ? d.attacker_size : d.defender_size,
      outcome: ((x0 > 0 && d.attacker_outcome == "win") || (x0 <= 0 && d.attacker_outcome == "loss"))  ? "Won" : "Lost"
    };});
  });

  var min_val = d3.min(current_battle_data, function(d) {
          return d.boxes["0"].x0;
          });

  var max_val = d3.max(current_battle_data, function(d) {
          return d.boxes["1"].x1;
          });

  x.domain([min_val, max_val]).nice();
  y.domain(current_battle_data.map(function(d) { return d.name; }));

  var loadChart = function(){
      svg.append("g")
           .attr("class", "x axis")
           .call(xAxis);

      svg.append("g")
          .attr("class", "y axis")
          .call(yAxis)

      var vakken = svg.selectAll(".name")
          .data(current_battle_data)
        .enter().append("g")
          .attr("class", "bar")
          .attr("transform", function(d) { return "translate(0," + y(d.name) + ")"; });

      var bars = vakken.selectAll("rect")
          .data(function(d) { return d.boxes; })
        .enter().append("g").attr("class", "subbar");

      bars.append("rect")
          .attr("height", y.rangeBand())
          .attr("x", function(d) { return x(d.x0); })
          .attr("width", function(d) { return x(d.x1) - x(d.x0); })
          .style("fill", function(d) { return color(d.name); })      
          .on('mouseover', tip_battle.show)
          .on('mouseout', tip_battle.hide);

      svg.append("g")
          .attr("class", "y axis")
      .append("line")
          .attr("x1", x(0))
          .attr("x2", x(0))
          .attr("y2", height);

      var startp = svg.append("g").attr("class", "legendbox").attr("id", "mylegendbox");
      var legend_tabs = [0, 120, 200, 375, 450];
      var legend = startp.selectAll(".legend")
          .data(color.domain().slice())
        .enter().append("g")
          .attr("class", "legend")
          .attr("transform", function(d, i) { return "translate(" + legend_tabs[i] + ",-45)"; });

      legend.append("rect")
          .attr("x", 0)
          .attr("width", 18)
          .attr("height", 18)
          .style("fill", color);

      legend.append("text")
          .attr("x", 22)
          .attr("y", 9)
          .attr("dy", ".35em")
          .style("text-anchor", "begin")
          .style("font" ,"10px sans-serif")
          .style("color" ,"#fff")
          .text(function(d) { return d; });

      d3.selectAll(".axis path")
          .style("fill", "none")
          .style("stroke", "#f5f5f5")
          .style("shape-rendering", "crispEdges")

      d3.selectAll(".axis line")
          .style("fill", "none")
          .style("stroke", "#f5f5f5")
          .style("shape-rendering", "crispEdges")

     vakken.insert("rect",":first-child")
          .attr("height", y.rangeBand())
          .attr("x", "1")
          .attr("width", width)
          .attr("fill-opacity", "0.2")
          .style("fill", "#777")
          .attr("class", function(d,index) { return index%2==0 ? "even" : "uneven"; });

      var movesize = width/2 - startp.node().getBBox().width/2;
      d3.selectAll(".legendbox").attr("transform", "translate(" + movesize  + ",0)");
  };

  loadChart();

  d3.select("select").on("change", change);

  function change(){
    var nY = y.domain(current_battle_data.sort(
              this.value == "attacker"
              ?  sortByAttacker
              : this.value == "defender"
                ? sortByDefender
                : this.value == "both"
                  ? sortByBoth
                  :  sortByName
            )
            .map(function(d) { return d.name; }))
            .copy();


    svg.selectAll(".bar")
        .sort(function(a, b) { return nY(b.name) - nY(a.name); });

    var transition = svg.transition().duration(250),
        delay = function(d, i) { return i * 50; };

    transition
        .selectAll(".bar")
        .delay(delay)
        .attr("transform", function(d) { return "translate(0," + nY(d.name) + ")"; });

    transition.select(".y.axis")
        .call(yAxis)
      .selectAll("g")
        .delay(delay);
  };

  updateSelectedKing = function(){
      current_battle_data = battle_data.filter(function(d) { 
        return selectedKing == "" || d.attacker_king == selectedKing || d.defender_king == selectedKing; 
     });

      current_battle_data.forEach(function(d) {
          d["Attacker Size"] = +d["attacker_size"];
          d["Defender Size"] = +d["defender_size"];
          var x0 = -1*(d["Defender Size"]);
          var idx = 0;
          d.boxes = color.domain().map(function(name) { return {
            name: name, 
            x0: x0, 
            x1: x0 += +d[name], 
            N: 2, 
            king: x0 > 0 ? d.attacker_king : d.defender_king,
            commander: x0 > 0 ? d.attacker_commander : d.defender_commander,
            size: x0 > 0 ? d.attacker_size : d.defender_size,
            outcome: ((x0 > 0 && d.attacker_outcome == "win") || (x0 <= 0 && d.attacker_outcome == "loss"))  ? "Won" : "Lost"
          };});
        });

    var updatedY = y.domain(current_battle_data.map(function(d) { return d.name; })).copy();

    // Select the section we want to apply our changes to
    var svg = d3.select("body").transition();

    // Make the changes
    svg.selectAll(".bar")   // change the line
        .duration(750)
        .attr("transform", function(d) { 
          return "translate(0," + (updatedY(d.name) || -100) + ")"; 
        });

    svg.select(".y.axis") // change the y axis
        .duration(750)
        .call(yAxis);

      console.log(selectedKing);
  };

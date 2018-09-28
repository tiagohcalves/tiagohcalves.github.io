var width = 400,
    height = 500;

function selectKing(d){
    if(d.name == selectedKing){
        clearSelectedKing();
    }
    else{
        selectedKing = d.name;
        updateSelectedKing();
        d3.select(".clear").style("display", "");
        d3.select(".king-name").text(selectedKing);
    }
}

var force = d3.layout.force()
    .gravity(0.01)
    .distance(150)
    .charge(-30)
    .size([width, height]);

var svg = d3.select("#battle-graph").append("svg")
    .attr("width", width)
    .attr("height", height);

force
    .nodes(graph.nodes)
    .links(graph.links)
    .start();

var link_king = svg.selectAll(".link")
    .data(graph.links)
  .enter().append("line")
    .attr("class", "link-king")
    .style("stroke-width", function(d) { return Math.sqrt(d.value/2); });

var node_king = svg.selectAll(".node")
    .data(graph.nodes)
  .enter().append("g")
    .attr("class", "node-king")
    .call(force.drag);

node_king.append("image")
    .attr("xlink:href", function (d) {return  "grafo-batalhas/" + d.group + ".png"})
    .attr("x", -8)
    .attr("y", -8)
    .attr("width", 50)
    .attr("height", 50)
    .on('click', selectKing);

node_king.append("text")
    .attr("dx", 12)
    .attr("dy", ".35em")
    .text(function(d) { return d.name });

force.on("tick", function() {
  link_king.attr("x1", function(d) { return d.source.x; })
      .attr("y1", function(d) { return d.source.y; })
      .attr("x2", function(d) { return d.target.x; })
      .attr("y2", function(d) { return d.target.y; });

  node_king.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
});
import {getData, moneyFormater} from "../components.js";
//render overview data
const month = new Date().getMonth() + 1;
const year = new Date().getFullYear();
let totalUser = await getData(`/api/admin/users/total?month=${month}&year=${year}`);
let totalOrderItem = await getData(`/api/admin/order-items/total?month=${month}&year=${year}`);
let totalOrder = await getData(`/api/admin/payments/total?month=${month}&year=${year}`);
let totalIncome = await getData(`/api/admin/payments/total-income?month=${month}&year=${year}`)

// Function to animate numbers counting up
function animateValue(elementId, start, end, increment, duration, formatter = null) {
    const element = document.getElementById(elementId);
    const range = end - start;
    const stepTime = Math.abs(Math.floor(duration / range));
    let current = start;
    increment = end > start ? end/increment : 0;

    const timer = setInterval(() => {
        current += increment;
        if (formatter) {
            element.innerHTML = formatter(current);
        } else {
            element.innerHTML = current;
        }

        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
            clearInterval(timer);
        }
    }, stepTime);
}

// Custom money formatter
function moneyFormatter(value) {
    return value.toLocaleString('vi-VN') + 'đ';
}

// Example usage


// Animate the values
animateValue('total-user', 0,totalUser['total'], totalUser['total'], 1000);
animateValue('total-product', 0,totalOrderItem['total'], totalOrderItem['total'], 1000);
animateValue('total-order', 0, totalOrder['total'], totalOrder['total'], 1000);
animateValue('total-income', 0, totalIncome['total'],100, 2000, moneyFormatter);

// Hàm tạo mảng đối tượng chứa ngày từ 30 ngày trước đến hiện tại
const generateLast30DaysData = () => {
    const result = [];
    const today = new Date();

    for (let i = 30; i >= 0; i--) {
        const date = new Date(today);
        date.setDate(today.getDate() - i);
        result.push({
            date: date.toISOString().split("T")[0],
            value: 0,
        });
    }
    return result;
};


// Sử dụng hàm
async function renderUserChart() {
    let users = await getData(`/api/admin/users`);
    const data = generateLast30DaysData();
    for (let user of users) {
        let createdDate = new Date(user['created_date']);
        let createdDateString = createdDate.toISOString().split("T")[0];
        for (let i = 0; i < data.length; i++) {
            let itemDateString = data[i].date;
            if (createdDateString <= itemDateString) {
                data[i].value += 1;
            }
        }
    }
    drawLineChart('#chart-container', data);
}

function drawLineChart(element, data) {
    const margin = { top: 20, right: 30, bottom: 50, left: 50 };
    const width = window.innerWidth * 0.7 - margin.left - margin.right;
    const height = window.innerHeight * 0.6 - margin.top - margin.bottom;
    const svg = d3.select(element)
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);
    const tooltip = d3.select(element)
        .append("div")
        .style("position", "absolute")
        .style("background-color", "white")
        .style("border", "1px solid #ccc")
        .style("padding", "8px")
        .style("border-radius", "4px")
        .style("box-shadow", "0px 0px 5px rgba(0,0,0,0.2)")
        .style("pointer-events", "none")
        .style("opacity", 0);
    const parseDate = d3.timeParse("%Y-%m-%d");
    data.forEach(d => {
        d.date = parseDate(d.date);
    });
    const xScale = d3.scaleTime()
        .domain(d3.extent(data, d => d.date))
        .range([0, width]);
    const yScale = d3.scaleLinear()
        .domain([0, d3.max(data, d => d.value)])
        .range([height, 0]);
    const xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%b %d"));
    const yAxis = d3.axisLeft(yScale);
    svg.append("g")
        .attr("transform", `translate(0, ${height})`)
        .call(xAxis);
    svg.append("g")
        .call(yAxis);
    const line = d3.line()
        .x(d => xScale(d.date))
        .y(d => yScale(d.value));
    svg.append("path")
        .datum(data)
        .attr("fill", "none")
        .attr("stroke", "#3299FE")
        .attr("stroke-width", 4)
        .attr("d", line);
    svg.selectAll("circle")
        .data(data)
        .enter()
        .filter((d, i, arr) => {
            return i === 0 || d.value !== data[i - 1].value;
        })
        .append("circle")
        .attr("cx", d => xScale(d.date))
        .attr("cy", d => yScale(d.value))
        .attr("r", 5)
        .attr("fill", "#DA5D5B")
        .style("cursor", "pointer")
        .on("mouseover", (event, d) => {
            tooltip.style("opacity", 1)
                .html(`<strong>Date:</strong> ${d3.timeFormat("%b %d, %Y")(d.date)}<br><strong>Value:</strong> ${d.value}`)
                .style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 20) + "px");
        })
        .on("mousemove", (event) => {
            tooltip.style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 20) + "px");
        })
        .on("mouseout", () => {
            tooltip.style("opacity", 0);
        });
}

function drawPieChartWithLegend(element, rawData) {
    // Xử lý dữ liệu: Lấy top 5 sản phẩm
    const sortedData = rawData.sort((a, b) => b.total_purchase - a.total_purchase);
    const top5 = sortedData.slice(0, 5);
    const othersTotal = sortedData.slice(5).reduce((sum, d) => sum + parseInt(d.total_purchase), 0);

    // Gộp dữ liệu
    const totalSales = sortedData.reduce((sum, d) => sum + parseInt(d.total_purchase), 0);
    const data = top5.map(d => ({
        name: d.product_name,
        value: parseInt(d.total_purchase),
        percentage: ((parseInt(d.total_purchase) / totalSales) * 100).toFixed(2),
    }));
    if (othersTotal > 0) {
        data.push({
            name: "Other",
            value: othersTotal,
            percentage: ((othersTotal / totalSales) * 100).toFixed(2),
        });
    }

    // Kích thước biểu đồ
    const width = 400;
    const height = 400;
    const radius = Math.min(width, height) / 2;

    // Tạo SVG
    const svg = d3.select(element)
        .append("svg")
        .attr("width", width)
        .attr("height", height + 100) // Tăng chiều cao cho chú thích
        .append("g")
        .attr("transform", `translate(${width / 2}, ${height / 2})`);

    // Tạo color scale
    const color = d3.scaleOrdinal()
        .domain(data.map(d => d.name))
        .range(d3.schemeCategory10);

    // Tạo tooltip
    const tooltip = d3.select(element)
        .append("div")
        .style("position", "absolute")
        .style("background-color", "white")
        .style("border", "1px solid #ccc")
        .style("padding", "8px")
        .style("border-radius", "4px")
        .style("box-shadow", "0px 0px 5px rgba(0,0,0,0.2)")
        .style("pointer-events", "none")
        .style("opacity", 0);

    // Tạo pie và arc
    const pie = d3.pie()
        .value(d => d.value);

    const arc = d3.arc()
        .innerRadius(0)
        .outerRadius(radius);

    const labelArc = d3.arc()
        .innerRadius(radius * 0.6)
        .outerRadius(radius * 0.6);

    // Vẽ các phần của biểu đồ
    svg.selectAll("path")
        .data(pie(data))
        .enter()
        .append("path")
        .attr("d", arc)
        .attr("fill", d => color(d.data.name))
        .style("stroke", "#fff")
        .style("stroke-width", "2px")
        .on("mouseover", (event, d) => {
            tooltip.style("opacity", 1)
                .html(`<strong>${d.data.name}</strong><br>Purchases: ${d.data.value}<br>Percentage: ${d.data.percentage}%`)
                .style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 20) + "px");
        })
        .on("mousemove", (event) => {
            tooltip.style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 20) + "px");
        })
        .on("mouseout", () => {
            tooltip.style("opacity", 0);
        });

    // Thêm nhãn phần trăm
    svg.selectAll("text")
        .data(pie(data))
        .enter()
        .append("text")
        .attr("transform", d => `translate(${labelArc.centroid(d)})`)
        .attr("text-anchor", "middle")
        .attr("dy", "0.35em")
        .style("font-size", "12px")
        .style("fill", "#fff")
        .text(d => `${d.data.percentage}%`);

    // Tạo chú thích
    const legend = d3.select(element)
        .append("div")
        .attr("class", "legend")
        .style("display", "flex")
        .style("flex-wrap", "wrap")
        .style("justify-content", "center")
        .style("margin-top", "20px")
        .style("max-width", "30vw");

    // Thêm từng mục vào chú thích
    data.forEach(d => {
        const legendItem = legend.append("div")
            .style("display", "flex")
            .style("align-items", "center")
            .style("margin", "0 10px");

        legendItem.append("div")
            .style("width", "12px")
            .style("height", "12px")
            .style("background-color", color(d.name))
            .style("margin-right", "8px");

        legendItem.append("span")
            .text(`${d.name} (${d.percentage}%)`)
            .style("font-size", "12px")
            .style("color", "#333");
    });
}

await renderUserChart();

document.getElementById('total-user-container').addEventListener('click', async function () {
    document.getElementById('chart-container').innerHTML = '';
    await renderUserChart();
    document.getElementById('chart-title').innerHTML = 'Total user in the lasted 30 days';
})

document.getElementById('product-box').addEventListener('click', async function() {
    document.getElementById('chart-container').innerHTML = '';
    let productsPurchase = await getData('/api/admin/order-items/chart');
    drawPieChartWithLegend('#chart-container', productsPurchase);
    document.getElementById('chart-title').innerHTML = 'Percentage of each products purchase in the last 30 days';
})

// Hiển thị biểu đồ cho orders
 
function prepareData(rawData) {
    const last15Days = [];
    const currentDate = new Date();
    for (let i = 0; i < 15; i++) {
        const day = new Date();
        day.setDate(currentDate.getDate() - i); 
        const formattedDate = d3.timeFormat("%Y-%m-%d")(day);
  
        const orderCount = rawData.filter(order => order.dateOnly === formattedDate)
                                  .reduce((sum, order) => sum + order.total, 0);
  
        last15Days.push({
            date: formattedDate,
            total: orderCount
        });
    }
    return last15Days.reverse(); 
}
function drawBarChart(element, data) {
    const margin = { top: 20, right: 30, bottom: 50, left: 50 };
    const width = window.innerWidth * 0.7 - margin.left - margin.right;
    const height = window.innerHeight * 0.6 - margin.top - margin.bottom;

    const svg = d3.select(element)
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    const tooltip = d3.select(element)
        .append("div")
        .attr("class", "tooltip")
        .style("position", "absolute")
        .style("background-color", "white")
        .style("border", "1px solid #ccc")
        .style("padding", "8px")
        .style("border-radius", "4px")
        .style("box-shadow", "0px 0px 5px rgba(0,0,0,0.2)")
        .style("pointer-events", "none")
        .style("opacity", 0);

    const parseDate = d3.timeParse("%Y-%m-%d");
    data.forEach(d => {
        d.date = parseDate(d.date);
    });

    const xScale = d3.scaleBand()
        .domain(data.map(d => d.date))
        .range([0, width])
        .padding(0.1); 

    const yScale = d3.scaleLinear()
        .domain([0, d3.max(data, d => d.total)])
        .range([height, 0]);

    const xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%b %d"));
    const yAxis = d3.axisLeft(yScale);

    svg.append("g")
        .attr("transform", `translate(0, ${height})`)
        .call(xAxis);

    svg.append("g")
        .call(yAxis);

    const colorScale = d3.scaleSequential(d3.interpolateBlues)
        .domain([0, d3.max(data, d => d.total)]);

    svg.selectAll(".bar")
        .data(data)
        .enter()
        .append("rect")
        .attr("class", "bar")
        .attr("x", d => xScale(d.date))
        .attr("y", d => yScale(d.total))
        .attr("width", xScale.bandwidth())
        .attr("height", d => height - yScale(d.total))
        .attr("fill", d => colorScale(d.total))
        .on("mouseover", (event, d) => {
            tooltip.style("opacity", 1)
                .html(`<strong>Date:</strong> ${d3.timeFormat("%b %d, %Y")(d.date)}<br><strong>Orders:</strong> ${d.total}`)
                .style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 40) + "px"); 
        })
        .on("mousemove", (event) => {
            tooltip.style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 40) + "px"); 
        })
        .on("mouseout", () => {
            tooltip.style("opacity", 0);
        });
}

document.getElementById('total-order-box').addEventListener('click', async function() {
    document.getElementById('chart-container').innerHTML = '';
    let orders = await getData('/api/admin/payments/chart');
    const data = prepareData(orders);
    drawBarChart("#chart-container", data);
    document.getElementById('chart-title').innerHTML = 'Total orders/day in the lasted 15 days';
})
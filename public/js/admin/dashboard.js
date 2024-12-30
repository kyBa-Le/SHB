import {getData, moneyFormater} from "../components.js";
//render overview data
const currentMonth = new Date().getMonth() + 1;
const currentYear = new Date().getFullYear();
let totalUser = await getData(`/api/admin/users/total?month=${currentMonth}&&year=${currentYear}`);
let totalOrderItem = await getData(`/api/admin/order-items/total?month=${currentMonth}&&year=${currentYear}`);
let totalOrder = await getData(`/api/admin/payments/total?month=${currentMonth}&&year=${currentYear}`);
let totalIncome = await getData(`/api/admin/payments/total-income?month=${currentMonth}&&year=${currentYear}`)

// Function to animate numbers counting up
function animateValue(elementId, start, end, increment, duration, formatter = null) {
    const element = document.getElementById(elementId);
    const range = end - start;
    const stepTime = Math.abs(Math.floor(duration / range));
    let current = start;
    increment = end > start ? end/increment : -1;

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

// Dữ liệu
const data = [
    { date: "2023-12-20", value: 10 },
    { date: "2023-12-21", value: 20 },
    { date: "2023-12-22", value: 15 },
    { date: "2023-12-23", value: 25 },
    { date: "2023-12-24", value: 30 },
];

// Kích thước SVG
const margin = { top: 20, right: 30, bottom: 50, left: 50 };
const width = 1000 - margin.left - margin.right;
const height = 500 - margin.top - margin.bottom;

// Tạo SVG
const svg = d3.select("#chart-container")
    .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", `translate(${margin.left},${margin.top})`);

// Chuyển đổi dữ liệu ngày
const parseDate = d3.timeParse("%Y-%m-%d");
data.forEach(d => {
    d.date = parseDate(d.date);
});

// Tạo scale cho X và Y
const xScale = d3.scaleTime()
    .domain(d3.extent(data, d => d.date))
    .range([0, width]);

const yScale = d3.scaleLinear()
    .domain([0, d3.max(data, d => d.value)])
    .range([height, 0]);

// Vẽ trục X và Y
const xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%b %d"));
const yAxis = d3.axisLeft(yScale);

svg.append("g")
    .attr("transform", `translate(0, ${height})`)
    .call(xAxis);

svg.append("g")
    .call(yAxis);

// Vẽ đường line
const line = d3.line()
    .x(d => xScale(d.date))
    .y(d => yScale(d.value));

svg.append("path")
    .datum(data)
    .attr("fill", "none")
    .attr("stroke", "steelblue")
    .attr("stroke-width", 2)
    .attr("d", line);

// Vẽ các điểm trên đường line
svg.selectAll("circle")
    .data(data)
    .enter()
    .append("circle")
    .attr("cx", d => xScale(d.date))
    .attr("cy", d => yScale(d.value))
    .attr("r", 4)
    .attr("fill", "red");

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


await renderUserChart();

document.getElementById('total-user-container').addEventListener('click', async function () {
    document.getElementById('chart-container').innerHTML = '';
    await renderUserChart();
    document.getElementById('chart-title').innerHTML = 'Total user in the lasted 30 days';
})

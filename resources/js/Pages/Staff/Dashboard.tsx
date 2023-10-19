import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import {
    LineChart,
    Line,
    CartesianGrid,
    XAxis,
    YAxis,
    Tooltip,
    ResponsiveContainer,
    Legend,
    BarChart,
    Bar,
} from "recharts";
import { useState } from "react";
import Calendar from "react-calendar";
import CalendarCard from "@/Components/ui/calendar-card";
import "react-calendar/dist/Calendar.css";
import { MdChevronLeft, MdChevronRight } from "react-icons/md";
import "../../../css/miniCalendar.css";

export default function Dashboard({ auth }: PageProps) {
    const stats = [
        {
            name: "Total Students",
            value: "240",
            subtitle: "some text",
        },
        {
            name: "Total Advisors",
            value: "54",
            subtitle: "some text",
        },
        { name: "Slots Available", value: "28", subtitle: "some text" },
        { name: "Total Groups", value: "120", subtitle: "some text" },
    ];
    // const data1 = {
    //     labels: ["Red", "Orange", "Blue"],
    //     // datasets is an array of objects where each object represents a set of data to display corresponding to the labels above. for brevity, we'll keep it at one object
    //     datasets: [
    //         {
    //             label: "Popularity of colours",
    //             data: [55, 23, 96],
    //             // you can set indiviual colors for each bar
    //             backgroundColor: [
    //                 "rgba(255, 255, 255, 0.6)",
    //                 "rgba(255, 255, 255, 0.6)",
    //                 "rgba(255, 255, 255, 0.6)",
    //             ],
    //             borderWidth: 1,
    //         },
    //     ],
    // };
    const data = [
        {
            name: "Mon",
            task: 6,
        },
        {
            name: "Tue",
            task: 8,
        },
        {
            name: "Wed",
            task: 5,
        },
        {
            name: "Thurs",
            task: 10,
        },
        {
            name: "Fri",
            task: 7,
        },
        {
            name: "Sat",
            task: 9,
        },
        {
            name: "Sun",
            task: 4,
        },
    ];
    type ValuePiece = Date | null;

    type Value = ValuePiece | [ValuePiece, ValuePiece];
    const [value, onChange] = useState<Value>(new Date());

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Staff Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            {/* <div className="flex flex-col justify-between gap-4 p-4 text-black">
                <div className="flex-1 mb-5 flex-row">
                    {stats.map((stat) => (
                        <section className="p-4 transition-all ease-in-out hover:border-primary hover:border-2 bg-white h-28 rounded-lg mb-5">
                            <h2 className="text-l font-bold">{stat.name}</h2>
                            <p className="text-2xl font-bold">{stat.value}</p>
                            <h3>{stat.subtitle}</h3>
                        </section>
                    ))}
                </div>

                <div className="flex-1 grid grid-cols-2 gap-4">
                    <section className="p-4 bg-white rounded-lg h-auto">
                        <h2 className="text-xl font-bold">Open Advisors</h2>
                        <p className="mb-6">Ads with posts</p>

                        Repeated sections for advisors
                        {advisors.map((advisor) => (
        <div className="flex gap-3 mb-10">
          <div className="bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center">
            FF
          </div>
          <div className="inline-flex items-center">{advisor.name}</div>
          <div className="inline-flex items-center">2 Slots</div>
        </div>
      ))}
                    </section>

                    <section className="p-4 mt-5 bg-white rounded-lg h-auto">
                        <h2 className="text-xl font-bold">Recent Activity</h2>
                        <p>Activity of all the projects</p>
                        <ul className="mt-6">
                            {activityItems.map((item) => (
          <li className="flex gap-1 mb-10">
            <div className="bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center">
              FF
            </div>
            <div className="flex flex-col">
              <div className="font-bold">{item.title}</div>
              <p>{item.description}</p>
            </div>
          </li>
        ))}
                        </ul>

                        <a href="#" className="flex justify-center gap-2 mb-4">
                            <div className="inline-flex font-bold align-text-top text-lg">
                                View all activities
                            </div>
                            <div className="inline-flex items-center w-4">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    className="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                                    />
                                </svg>
                            </div>
                        </a>
                    </section>
                </div>
            </div> */}

            <div className="grid grid-rows-2-4  p-4 text-black">
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-5">
                    {stats.map((stat) => (
                        <Card className=" p-4 flex-1 transition-all ease-in-out hover:border-primary hover:border-2 bg-white h-28 rounded-lg">
                            <h2 className="text-l font-bold">{stat.name}</h2>
                            <p className="text-2xl font-bold">{stat.value}</p>
                            <h3>{stat.subtitle}</h3>
                        </Card>
                    ))}
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <Card className="">
                            <CardHeader>
                                <CardTitle>
                                    <h2 className="text-xl font-bold">
                                        Recent Activity
                                    </h2>
                                </CardTitle>
                                <CardDescription>
                                    <p>Activity of all the projects</p>
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="">
                                    <li>
                                        <div className="flex  gap-1 mb-10 ">
                                            <div className="flex gap-3">
                                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                                    FF
                                                </div>
                                                <div className="flex flex-col">
                                                    <div className="font-bold">
                                                        FYP Forge | Olivia
                                                        Martin
                                                    </div>
                                                    <p className="">
                                                        5 mins ago - updated
                                                        project details
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div className="flex  gap-1 mb-10 ">
                                            <div className="flex gap-3">
                                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                                    FF
                                                </div>
                                                <div className="flex flex-col">
                                                    <div className="font-bold">
                                                        FYP Forge | Jackson Las
                                                        Martin
                                                    </div>
                                                    <p className="">
                                                        1 hr ago - Submitted for
                                                        approval
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div className="flex  gap-1 mb-10 ">
                                            <div className="flex gap-3">
                                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                                    FF
                                                </div>
                                                <div className="flex flex-col">
                                                    <div className="font-bold">
                                                        SZABDESK | Isabella
                                                        Nguyen Martin
                                                    </div>
                                                    <p className="">
                                                        2 hrs ago - Marked by
                                                        panel
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div className="flex  gap-1 mb-10 ">
                                            <div className="flex gap-3">
                                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                                    FF
                                                </div>
                                                <div className="flex flex-col">
                                                    <div className="font-bold">
                                                        FYP Forge | Willian Kim
                                                        Martin
                                                    </div>
                                                    <p className="">
                                                        6 hrs ago - updated
                                                        project details
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div className="flex  gap-1 mb-10 ">
                                            <div className="flex gap-3">
                                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                                    FF
                                                </div>
                                                <div className="flex flex-col">
                                                    <div className="font-bold">
                                                        FYP Forge | Sofia Davis
                                                        Martin
                                                    </div>
                                                    <p className="">
                                                        5 mins ago - updated
                                                        project details
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <a
                                    href="#"
                                    className="flex justify-center gap-2 mb-4"
                                >
                                    <div className="inline-flex font-bold align-text-top text-lg">
                                        View all activities
                                    </div>
                                    <div className="inline-flex items-center w-4">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            strokeWidth={1.5}
                                            stroke="currentColor"
                                            className="w-6 h-6"
                                        >
                                            <path
                                                strokeLinecap="round"
                                                strokeLinejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5"
                                            />
                                        </svg>
                                    </div>
                                </a>
                            </CardContent>
                        </Card>
                    </div>
                    <div>
                        <Card>
                            <CardHeader>
                                <CardTitle className="text-center text-xl">
                                    Graph
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <ResponsiveContainer height={305}>
                                    <LineChart data={data}>
                                        <CartesianGrid strokeDasharray="3 3" />
                                        <XAxis
                                            allowDataOverflow={false}
                                            dataKey="name"
                                        />
                                        <YAxis width={20} />
                                        <Tooltip />
                                        <Legend />
                                        <Line
                                            type="monotone"
                                            dataKey="task"
                                            stroke="#8884d8"
                                            strokeWidth={2}
                                        />
                                    </LineChart>
                                </ResponsiveContainer>
                            </CardContent>
                        </Card>
                    </div>
                    <div>
                        <Card>
                            <CardHeader>
                                <CardTitle className="text-center text-xl">
                                    Task Completion Chart
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="">
                                <ResponsiveContainer height={303}>
                                    <BarChart data={data}>
                                        <XAxis dataKey="name" interval={0} />
                                        <YAxis width={20} />
                                        <Bar dataKey="task" fill="#8884d8" />
                                    </BarChart>
                                </ResponsiveContainer>
                            </CardContent>
                        </Card>
                    </div>
                    <div>
                        <Card>
                            <CardHeader>
                                <CardTitle className="text-center text-xl">
                                    Calender
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="flex justify-center">
                                {/* <CalendarCard extra="flex w-full h-full flex-col px-3 py-3"> */}
                                <Calendar
                                    onChange={onChange}
                                    value={value}
                                    prevLabel={
                                        <MdChevronLeft className="ml-1 h-6 w-6 " />
                                    }
                                    nextLabel={
                                        <MdChevronRight className="ml-1 h-6 w-6 " />
                                    }
                                    view={"month"}
                                />
                                {/* </CalendarCard> */}
                            </CardContent>
                        </Card>
                        <Card>
                            {/* <div className="flex flex-col justify-center items-center h-[100vh]">
                                <div className="relative flex flex-col w-[350px] rounded-[10px] border-[1px] border-gray-200 bg-white bg-clip-border shadow-md shadow-[#F3F3F3] dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none pb-7 p-[20px]">
                                    <div className="relative flex flex-row justify-between">
                                        <div className="flex items-center">
                                            <div className="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-100 dark:bg-white/5">
                                                <svg
                                                    stroke="currentColor"
                                                    fill="currentColor"
                                                    stroke-width="0"
                                                    viewBox="0 0 24 24"
                                                    className="h-6 w-6 text-brand-500 dark:text-white"
                                                    height="1em"
                                                    width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill="none"
                                                        d="M0 0h24v24H0z"
                                                    ></path>
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                                </svg>
                                            </div>
                                            <h4 className="ml-4 text-xl font-bold text-navy-700 dark:text-white">
                                                Tasks
                                            </h4>
                                        </div>
                                        <div className="relative flex">
                                            <div className="flex">
                                                <button className="flex items-center text-xl hover:cursor-pointer bg-lightPrimary p-2 text-brand-500 hover:bg-gray-100 dark:bg-navy-700 dark:text-white dark:hover:bg-white/20 dark:active:bg-white/10 linear justify-center rounded-md font-bold transition duration-200">
                                                    <svg
                                                        stroke="currentColor"
                                                        fill="currentColor"
                                                        stroke-width="0"
                                                        viewBox="0 0 16 16"
                                                        className="h-6 w-6"
                                                        height="1em"
                                                        width="1em"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div className="top-11 right-0 w-max absolute z-10 origin-top-right transition-all duration-300 ease-in-out scale-0">
                                                <div className="z-50 w-max rounded-md bg-white px-4 py-3 text-sm shadow-xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                                                    <p className="hover:text-black flex cursor-pointer items-center gap-2 text-gray-600 hover:font-medium">
                                                        <span>
                                                            <svg
                                                                stroke="currentColor"
                                                                fill="currentColor"
                                                                stroke-width="0"
                                                                viewBox="0 0 1024 1024"
                                                                height="1em"
                                                                width="1em"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <path d="M858.5 763.6a374 374 0 0 0-80.6-119.5 375.63 375.63 0 0 0-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 0 0-80.6 119.5A371.7 371.7 0 0 0 136 901.8a8 8 0 0 0 8 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 0 0 8-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z"></path>
                                                            </svg>
                                                        </span>
                                                        Panel 1
                                                    </p>
                                                    <p className="hover:text-black mt-2 flex cursor-pointer items-center gap-2 pt-1 text-gray-600 hover:font-medium">
                                                        <span>
                                                            <svg
                                                                stroke="currentColor"
                                                                fill="currentColor"
                                                                stroke-width="0"
                                                                viewBox="0 0 1024 1024"
                                                                height="1em"
                                                                width="1em"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <path d="M882 272.1V144c0-17.7-14.3-32-32-32H174c-17.7 0-32 14.3-32 32v128.1c-16.7 1-30 14.9-30 31.9v131.7a177 177 0 0 0 14.4 70.4c4.3 10.2 9.6 19.8 15.6 28.9v345c0 17.6 14.3 32 32 32h676c17.7 0 32-14.3 32-32V535a175 175 0 0 0 15.6-28.9c9.5-22.3 14.4-46 14.4-70.4V304c0-17-13.3-30.9-30-31.9zM214 184h596v88H214v-88zm362 656.1H448V736h128v104.1zm234 0H640V704c0-17.7-14.3-32-32-32H416c-17.7 0-32 14.3-32 32v136.1H214V597.9c2.9 1.4 5.9 2.8 9 4 22.3 9.4 46 14.1 70.4 14.1s48-4.7 70.4-14.1c13.8-5.8 26.8-13.2 38.7-22.1.2-.1.4-.1.6 0a180.4 180.4 0 0 0 38.7 22.1c22.3 9.4 46 14.1 70.4 14.1 24.4 0 48-4.7 70.4-14.1 13.8-5.8 26.8-13.2 38.7-22.1.2-.1.4-.1.6 0a180.4 180.4 0 0 0 38.7 22.1c22.3 9.4 46 14.1 70.4 14.1 24.4 0 48-4.7 70.4-14.1 3-1.3 6-2.6 9-4v242.2zm30-404.4c0 59.8-49 108.3-109.3 108.3-40.8 0-76.4-22.1-95.2-54.9-2.9-5-8.1-8.1-13.9-8.1h-.6c-5.7 0-11 3.1-13.9 8.1A109.24 109.24 0 0 1 512 544c-40.7 0-76.2-22-95-54.7-3-5.1-8.4-8.3-14.3-8.3s-11.4 3.2-14.3 8.3a109.63 109.63 0 0 1-95.1 54.7C233 544 184 495.5 184 435.7v-91.2c0-.3.2-.5.5-.5h655c.3 0 .5.2.5.5v91.2z"></path>
                                                            </svg>
                                                        </span>
                                                        Panel 2
                                                    </p>
                                                    <p className="hover:text-black mt-2 flex cursor-pointer items-center gap-2 pt-1 text-gray-600 hover:font-medium">
                                                        <span>
                                                            <svg
                                                                stroke="currentColor"
                                                                fill="currentColor"
                                                                stroke-width="0"
                                                                version="1.2"
                                                                baseProfile="tiny"
                                                                viewBox="0 0 24 24"
                                                                height="1em"
                                                                width="1em"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <g>
                                                                    <path d="M12.5 5.5c-.276 0-.5.224-.5.5s.224.5.5.5c1.083 0 1.964.881 1.964 1.964 0 .276.224.5.5.5s.5-.224.5-.5c0-1.634-1.33-2.964-2.964-2.964zM12.5 1c-4.136 0-7.5 3.364-7.5 7.5 0 1.486.44 2.922 1.274 4.165l.08.135c1.825 2.606 2.146 3.43 2.146 4.2v3c0 .552.448 1 1 1h2c0 .26.11.52.29.71.19.18.45.29.71.29.26 0 .52-.11.71-.29.18-.19.29-.45.29-.71h2c.552 0 1-.448 1-1v-3c0-.782.319-1.61 2.132-4.199.895-1.275 1.368-2.762 1.368-4.301 0-4.136-3.364-7.5-7.5-7.5zm2 18h-4v-1h4v1zm2.495-7.347c-1.466 2.093-2.143 3.289-2.385 4.347h-1.11v-2c0-.552-.448-1-1-1s-1 .448-1 1v2h-1.113c-.24-1.03-.898-2.2-2.306-4.22l-.077-.129c-.657-.934-1.004-2.024-1.004-3.151 0-3.033 2.467-5.5 5.5-5.5s5.5 2.467 5.5 5.5c0 1.126-.347 2.216-1.005 3.153z"></path>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        Panel 3
                                                    </p>
                                                    <p className="hover:text-black mt-2 flex cursor-pointer items-center gap-2 pt-1 text-gray-600 hover:font-medium">
                                                        <span>
                                                            <svg
                                                                stroke="currentColor"
                                                                fill="none"
                                                                stroke-width="2"
                                                                viewBox="0 0 24 24"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                height="1em"
                                                                width="1em"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <circle
                                                                    cx="12"
                                                                    cy="12"
                                                                    r="3"
                                                                ></circle>
                                                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                                            </svg>
                                                        </span>
                                                        Panel 4
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="h-full w-full">
                                        <div className="mt-5 flex items-center justify-between p-2">
                                            <div className="flex items-center justify-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    className="defaultCheckbox relative flex h-[20px] min-h-[20px] w-[20px] min-w-[20px] appearance-none items-center 
      justify-center rounded-md border border-gray-300 text-white/0 outline-none transition duration-[0.2s]
      checked:border-none checked:text-white hover:cursor-pointer dark:border-white/10 checked:bg-brand-500 dark:checked:bg-brand-400 undefined"
                                                    name="weekly"
                                                />
                                                <p className="text-base font-bold text-navy-700 dark:text-white">
                                                    Landing Page Design
                                                </p>
                                            </div>
                                            <div>
                                                <svg
                                                    stroke="currentColor"
                                                    fill="currentColor"
                                                    stroke-width="0"
                                                    viewBox="0 0 24 24"
                                                    className="h-6 w-6 text-navy-700 dark:text-white"
                                                    height="1em"
                                                    width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill="none"
                                                        d="M0 0h24v24H0V0z"
                                                    ></path>
                                                    <path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div className="mt-2 flex items-center justify-between p-2">
                                            <div className="flex items-center justify-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    className="defaultCheckbox relative flex h-[20px] min-h-[20px] w-[20px] min-w-[20px] appearance-none items-center 
      justify-center rounded-md border border-gray-300 text-white/0 outline-none transition duration-[0.2s]
      checked:border-none checked:text-white hover:cursor-pointer dark:border-white/10 checked:bg-brand-500 dark:checked:bg-brand-400 undefined"
                                                    name="weekly"
                                                />
                                                <p className="text-base font-bold text-navy-700 dark:text-white">
                                                    Mobile App Design
                                                </p>
                                            </div>
                                            <div>
                                                <svg
                                                    stroke="currentColor"
                                                    fill="currentColor"
                                                    stroke-width="0"
                                                    viewBox="0 0 24 24"
                                                    className="h-6 w-6 text-navy-700 dark:text-white"
                                                    height="1em"
                                                    width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill="none"
                                                        d="M0 0h24v24H0V0z"
                                                    ></path>
                                                    <path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div className="mt-2 flex items-center justify-between p-2">
                                            <div className="flex items-center justify-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    className="defaultCheckbox relative flex h-[20px] min-h-[20px] w-[20px] min-w-[20px] appearance-none items-center 
      justify-center rounded-md border border-gray-300 text-white/0 outline-none transition duration-[0.2s]
      checked:border-none checked:text-white hover:cursor-pointer dark:border-white/10 checked:bg-brand-500 dark:checked:bg-brand-400 undefined"
                                                    name="weekly"
                                                />
                                                <p className="text-base font-bold text-navy-700 dark:text-white">
                                                    Dashboard Builder
                                                </p>
                                            </div>
                                            <div>
                                                <svg
                                                    stroke="currentColor"
                                                    fill="currentColor"
                                                    stroke-width="0"
                                                    viewBox="0 0 24 24"
                                                    className="h-6 w-6 text-navy-700 dark:text-white"
                                                    height="1em"
                                                    width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill="none"
                                                        d="M0 0h24v24H0V0z"
                                                    ></path>
                                                    <path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div className="mt-2 flex items-center justify-between p-2">
                                            <div className="flex items-center justify-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    className="defaultCheckbox relative flex h-[20px] min-h-[20px] w-[20px] min-w-[20px] appearance-none items-center 
      justify-center rounded-md border border-gray-300 text-white/0 outline-none transition duration-[0.2s]
      checked:border-none checked:text-white hover:cursor-pointer dark:border-white/10 checked:bg-brand-500 dark:checked:bg-brand-400 undefined"
                                                    name="weekly"
                                                />
                                                <p className="text-base font-bold text-navy-700 dark:text-white">
                                                    Landing Page Design
                                                </p>
                                            </div>
                                            <div>
                                                <svg
                                                    stroke="currentColor"
                                                    fill="currentColor"
                                                    stroke-width="0"
                                                    viewBox="0 0 24 24"
                                                    className="h-6 w-6 text-navy-700 dark:text-white"
                                                    height="1em"
                                                    width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill="none"
                                                        d="M0 0h24v24H0V0z"
                                                    ></path>
                                                    <path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div className="mt-2 flex items-center justify-between p-2">
                                            <div className="flex items-center justify-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    className="defaultCheckbox relative flex h-[20px] min-h-[20px] w-[20px] min-w-[20px] appearance-none items-center 
      justify-center rounded-md border border-gray-300 text-white/0 outline-none transition duration-[0.2s]
      checked:border-none checked:text-white hover:cursor-pointer dark:border-white/10 checked:bg-brand-500 dark:checked:bg-brand-400 undefined"
                                                    name="weekly"
                                                />
                                                <p className="text-base font-bold text-navy-700 dark:text-white">
                                                    Dashboard Builder
                                                </p>
                                            </div>
                                            <div>
                                                <svg
                                                    stroke="currentColor"
                                                    fill="currentColor"
                                                    stroke-width="0"
                                                    viewBox="0 0 24 24"
                                                    className="h-6 w-6 text-navy-700 dark:text-white"
                                                    height="1em"
                                                    width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill="none"
                                                        d="M0 0h24v24H0V0z"
                                                    ></path>
                                                    <path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p className="font-normal text-navy-700 mt-20 mx-auto w-max">
                                    Profile Card component from{" "}
                                    <a
                                        href="https://horizon-ui.com?ref=tailwindcomponents.com"
                                        target="_blank"
                                        className="text-brand-500 font-bold"
                                    >
                                        Horizon UI Tailwind React
                                    </a>
                                </p>
                            </div> */}
                        </Card>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

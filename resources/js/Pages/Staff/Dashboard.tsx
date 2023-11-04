import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head} from "@inertiajs/react";
import {PageProps} from "@/types";
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import {
    LineChart,
    Line,
    XAxis,
    YAxis,
    Tooltip,
    ResponsiveContainer,
    BarChart,
    Bar,
} from "recharts";
import {useState} from "react";
import {Calendar} from "@/Components/ui/calendar";

export default function Dashboard({auth}: PageProps) {
    const [date, setDate] = useState<Date | undefined>(new Date())
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
        {name: "Slots Available", value: "28", subtitle: "some text"},
        {name: "Total Groups", value: "120", subtitle: "some text"},
    ];
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
            <Head title="Dashboard"/>

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
                        <div key={stat.name}
                             className="border bg-card text-card-foreground shadow-sm p-4 flex-1 transition-all ease-in-out hover:border-primary hover:border-2 bg-white h-28 rounded-lg">
                            <h2 className="text-l font-bold">{stat.name}</h2>
                            <p className="text-2xl font-bold">{stat.value}</p>
                            <h3>{stat.subtitle}</h3>
                        </div>
                    ))}
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <Card className="">
                            <CardHeader>
                                <CardTitle>
                                    Recent Activity
                                </CardTitle>
                                <CardDescription>
                                    Activity of all the projects
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="">
                                    <li>
                                        <div className="flex  gap-1 mb-10 ">
                                            <div className="flex gap-3">
                                                <div
                                                    className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
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
                                                <div
                                                    className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
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
                                                <div
                                                    className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
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
                                                <div
                                                    className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
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
                                                <div
                                                    className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
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
                                <ResponsiveContainer width="100%" height={350}>
                                    <LineChart data={data}>
                                        {/*<CartesianGrid strokeDasharray="3 3"/>*/}
                                        <XAxis
                                            // allowDataOverflow={false}
                                            dataKey="name"
                                            stroke="#888888"
                                            fontSize={12}
                                            tickLine={false}
                                            axisLine={false}
                                        />
                                        <YAxis
                                            width={14}
                                            stroke="#888888"
                                            fontSize={12}
                                            tickLine={false}
                                            axisLine={false}
                                        />
                                        <Tooltip/>
                                        {/*<Legend/>*/}
                                        <Line
                                            type="step"
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
                                <ResponsiveContainer width="100%" height={350}>
                                    <BarChart data={data}>
                                        <Tooltip/>
                                        <XAxis
                                            dataKey="name"
                                            stroke="#888888"
                                            fontSize={12}
                                            tickLine={false}
                                            axisLine={false}
                                            interval={0}/>
                                        <YAxis
                                            width={14}
                                            stroke="#888888"
                                            fontSize={12}
                                            tickLine={false}
                                            axisLine={false}
                                        />
                                        <Bar dataKey="task" fill="#8884d8" radius={[4, 4, 0, 0]}/>
                                    </BarChart>
                                </ResponsiveContainer>
                            </CardContent>
                        </Card>
                    </div>
                    <div>
                        <Card>
                            <CardHeader>
                                <CardTitle className="text-center text-xl">
                                    Schedule a meeting
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="flex justify-center">
                                <Calendar
                                    mode="single"
                                    selected={date}
                                    onSelect={setDate}
                                />
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

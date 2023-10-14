import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";

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

            <div className="grid grid-rows-2-4  p-4 text-black">
                <div className="grid grid-cols-4  gap-5 mb-5">
                    {stats.map((stat) => (
                        <section className=" p-4 transition-all ease-in-out hover:border-primary hover:border-2 bg-white h-28 rounded-lg">
                            <h2 className="text-l font-bold">{stat.name}</h2>
                            <p className="text-2xl font-bold">{stat.value}</p>
                            <h3>{stat.subtitle}</h3>
                        </section>
                    ))}
                </div>
                <div className="grid grid-cols-2  gap-4 items-center">
                    <section className="p-4 ml-12  bg-white rounded-lg h-auto">
                        <h2 className="text-xl font-bold">Open Advisors</h2>
                        <p className="mb-6">Ads with posts</p>
                        <div className="flex justify-between gap-1 mb-10 ">
                            <div className="flex gap-3 ">
                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                    FF
                                </div>
                                <div className="inline-flex items-center">
                                    Olivi Martin
                                </div>
                            </div>
                            <div>
                                <div className="inline-flex items-center">
                                    2 Slots
                                </div>
                            </div>
                        </div>
                        <div className="flex justify-between gap-1 mb-10">
                            <div className="flex gap-3 ">
                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                    FF
                                </div>
                                <div className="inline-flex items-center">
                                    Jackson Lee
                                </div>
                            </div>
                            <div>
                                <div className="inline-flex items-center">
                                    2 Slots
                                </div>
                            </div>
                        </div>
                        <div className="flex justify-between gap-1 mb-10">
                            <div className="flex gap-3 ">
                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                    FF
                                </div>
                                <div className="inline-flex items-center">
                                    Olivi Martin
                                </div>
                            </div>
                            <div>
                                <div className="inline-flex items-center">
                                    2 Slots
                                </div>
                            </div>
                        </div>
                        <div className="flex justify-between gap-1 mb-10 ">
                            <div className="flex gap-3 ">
                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                    FF
                                </div>
                                <div className="inline-flex items-center">
                                    Olivi Martin
                                </div>
                            </div>
                            <div>
                                <div className="inline-flex items-center">
                                    2 Slots
                                </div>
                            </div>
                        </div>
                        <div className="flex justify-between gap-1 mb-10 ">
                            <div className="flex gap-3 ">
                                <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                    FF
                                </div>
                                <div className="inline-flex items-center">
                                    Olivi Martin
                                </div>
                            </div>
                            <div>
                                <div className="inline-flex items-center">
                                    2 Slots
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="p-4 mr-32 mt-5 bg-white rounded-lg h-auto">
                        <h2 className="text-xl font-bold">Recent Activity</h2>
                        <p>Activity of all the projects</p>
                        <ul className="mt-6">
                            <li>
                                <div className="flex  gap-1 mb-10 ">
                                    <div className="flex gap-3">
                                        <div className=" bg-gray-100 w-12 h-12 rounded-full inline-flex items-center justify-center ">
                                            FF
                                        </div>
                                        <div className="flex flex-col">
                                            <div className="font-bold">
                                                FYP Forge | Olivia Martin
                                            </div>
                                            <p className="">
                                                5 mins ago - updated project
                                                details
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
                                                FYP Forge | Jackson Las Martin
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
                                                SZABDESK | Isabella Nguyen
                                                Martin
                                            </div>
                                            <p className="">
                                                2 hrs ago - Marked by panel
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
                                                FYP Forge | Willian Kim Martin
                                            </div>
                                            <p className="">
                                                6 hrs ago - updated project
                                                details
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
                                                FYP Forge | Sofia Davis Martin
                                            </div>
                                            <p className="">
                                                5 mins ago - updated project
                                                details
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
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
                    </section>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

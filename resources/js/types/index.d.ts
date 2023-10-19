export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type Student = {
    id: number;
    name: string;
    email: string;
    registration_no: string;
    email_verified_at: string;
};

export type Advisor = {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
};

export type PaginationLinks = {
    url?: string,
    label: string,
    active: boolean,
};


export type PaginatedData<T> = {
    data: T[],
    links: PaginationLinks[],
    first_page_url: string,
    next_page_url: string,
    prev_page_url: string,
    last_page: number,
    last_page_url: string,
    path: string,
    current_page: number,
    per_page: number,
    from: number,
    to: number,
    total: number,
};

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};

export type Project = { id: number }
